<?php
namespace Application\Controller;

require_once (BASE_PATH . '/api/Okay.php');
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class Controller
 * @package Application\Controller
 */
abstract class Controller
{
    /**
     * Class name of the default controller to load.
     *
     * @var string
     */
    const DEFAULT_CONTROLLER = 'Auth';

    /**
     * String to append to controller method name call.
     *
     * @var string
     */
    const METHOD_SUFFIX = 'Action';

    /**
     * URL segments relative to the root of the application. This includes the
     * controller.
     *
     * @var array
     */
    private $urlSegments = array();

    /**
     * The request object.
     *
     * @var \Slim\Http\Request
     */
    private $request;

    /**
     * The response object.
     *
     * @var \Slim\Http\Response
     */
    private $response;

    /**
     * @var \Okay
     */
    public $okay;

    /**
     * @var string
     */
    private $token;

    const DEFAULT_API_KEY_HEADER = 'X-OKAYCMS-API-KEY';

    public $HTTP_STATUS_CODE_200 = 200;
    public $HTTP_STATUS_CODE_204 = 204;
    public $HTTP_STATUS_CODE_400 = 400;
    public $HTTP_STATUS_CODE_403 = 403;
    public $HTTP_STATUS_CODE_404 = 404;
    public $HTTP_STATUS_CODE_406 = 406;
    public $HTTP_STATUS_CODE_500 = 500;
    public $HTTP_STATUS_CODE_501 = 501;

    public $API_STATUS_CODE_BRAND_NOT_FOUND = 100404;
    public $API_STATUS_CODE_BRAND_NULL_FILTER = 100204;
    public $API_STATUS_CODE_PRODUCT_NOT_FOUND = 200404;
    public $API_STATUS_CODE_PRODUCT_NULL_FILTER = 200204;
    public $API_STATUS_CODE_VARIANT_NOT_FOUND = 300404;
    public $API_STATUS_CODE_CATEGORY_NOT_FOUND = 400404;
    public $API_STATUS_CODE_TOKEN_IS_EXPIRED_OR_INVALID = 500404;
    public $API_STATUS_CODE_TOKEN_IS_VALID = 500200;
    public $API_STATUS_CODE_TOKEN_SERVER_ERROR = 500500;


    /**
     * Constructor.
     *
     * @param \Slim\Http\Request
     * @param \Slim\Http\Response
     */
    public function __construct(Request $request, Response $response)
    {
        $this->setRequest($request);
        $this->setResponse($response);
        $this->setUrlSegments($request);
        $this->okay = new \Okay();
        $this->token = $this->getRequest()->getHeaderLine(self::DEFAULT_API_KEY_HEADER);

    }

    /**
     * Call the requested controller method to process the response and return the
     * response.
     *
     * NOTE: The response object is automatically set to JSON if the returned data
     * type of the request method is an array.
     *
     * @return \Slim\Http\Response
     */
    public function getRequestResponse()
    {
        $request = $this->getRequest();
        $response = $this->getResponse();

        $method = $this->getMethod($request);

        $requestResponse = $this->callAction($method, array($request, $response));

        if ($requestResponse instanceof Response) {

            return $requestResponse;
        }

        if (gettype($requestResponse) === 'string') {

            return $response->write($requestResponse);
        }

        try {

            return $response->withJson($requestResponse);
        } catch (\RuntimeException $e) {

            return $response->withStatus(500)->write(sprintf(
                '%s: %s',
                $e->getCode(),
                $e->getMessage()
            ));
        }
    }

    /**
     * Set the request object.
     *
     * @param \Slim\Http\Request
     */
    protected function setRequest(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Get the request object.
     *
     * @return \Slim\Http\Request
     */
    protected function getRequest()
    {
        return $this->request;
    }

    /**
     * Set the response object.
     *
     * @param \Slim\Http\Response
     */
    protected function setResponse(Response $response)
    {
        $this->response = $response;
    }

    /**
     * Get the response object.
     *
     * @return \Slim\Http\Response
     */
    protected function getResponse()
    {
        return $this->response;
    }

    /**
     * Collects the URL segments from route and builds a numeric array with the
     * controller in index 0.
     *
     * @param \Slim\Http\Request
     */
    protected function setUrlSegments(Request $request)
    {
        $route = $request->getAttribute('route');

        $arguments = $route->getArguments();

        $segments[] = isset($arguments['controller']) ?
            $arguments['controller'] :
            strtolower(self::DEFAULT_CONTROLLER);

        if (isset($arguments['segments'])) {
            $segments = array_merge($segments, explode(
                '/',
                $arguments['segments']
            ));
        }

        $this->urlSegments = $segments;
    }

    /**
     * Get all URL segments.
     *
     * @return array
     */
    protected function getUrlSegments()
    {
        return $this->urlSegments;
    }

    /**
     * Get the URL segment specified by index.
     *
     * @param bool
     * @return mixed
     */
    protected function getUrlSegment($index)
    {
        if (isset($this->urlSegments[$index])) {

            return $this->urlSegments[$index];
        }

        return null;
    }

    /**
     * Построение фильтра из URL адреса и параметров запроса
     * @param $allowed_filters
     * @return array
     */
    protected function fetchAll($allowed_filters)
    {
        $filter = array();
        $arguments = $this->getUrlSegments();
        $params = $this->request->getParams();

        /**
         * Get url params after '?'
         */
        if(!empty($params)){
            foreach ($params as $param => $value){
                if(in_array($param, $allowed_filters)) {
                    $filter[$param] = $value;
                }
            }
        }

        /**
         * Get params from url
         */
        if(!empty($arguments[1])){
            $filter_name = $arguments[1];
            if(in_array($filter_name, $allowed_filters)) {
                if (!empty($arguments[2])) {
                    $filter_value = $arguments[2];
                    $filter[$filter_name] = $filter_value;
                    return $filter;
                }
            }
            return $filter;
        }
        return $filter;
    }

    /**
     * Get only second param from url
     * @return int|null|string
     */
    protected function fetchSingle()
    {
        $arguments = $this->getUrlSegments();
        if (!is_null($arguments[1])) {
            if(is_numeric($arguments[1])){
                return (int) $arguments[1];
            }else{
                return (string) $arguments[1];
            }
        }
        return null;
    }


    /**
     * @return string
     */
    protected function validateToken()
    {
        if($this->checkToken()){
            return $this->handleResponse($this->HTTP_STATUS_CODE_200, $this->getApiStatusCodeMessage($this->API_STATUS_CODE_TOKEN_IS_VALID));
        }else{
            if(!empty($this->token)){
                return $this->handleResponse($this->HTTP_STATUS_CODE_400, $this->getApiStatusCodeMessage($this->API_STATUS_CODE_TOKEN_IS_EXPIRED_OR_INVALID));
            }
            $this->okay->restapi->clear_expired_tokens();
            $token = md5(microtime());
            $token_expire  = date('Y-m-d H:i:s',strtotime('+3 hour',strtotime(date("Y-m-d H:i:s"))));
            $token_model = array(
                'token'         => $token,
                'token_expire'  => $token_expire
            );
            if($this->okay->restapi->add_token($token_model)){
                return $this->handleResponse($this->HTTP_STATUS_CODE_200, $token);
            }
            return $this->handleResponse($this->HTTP_STATUS_CODE_500, $this->getApiStatusCodeMessage($this->API_STATUS_CODE_TOKEN_SERVER_ERROR));
        }
    }

    /**
     * Check token
     * @return bool
     */
    protected function checkToken()
    {
        if(empty($this->token)) {
            return false;
        }

        $token = $this->okay->restapi->get_token($this->token);
        if(is_null($token) || empty($token)) {
            return false;
        }

        $current_time = date("Y-m-d H:i:s");
        if($token->token_expire > $current_time) {
            return true;
        }else{
            return false;
        }
    }


    /**
     * @param int
     * @param string
     * @return \Slim\Http\Response
     */
    protected function handleResponse($code, $message)
    {
        return $this->getResponse()->withStatus($code)
            ->withHeader('Content-Type', 'application/json')
            ->withJson(array(
                    'status'    => $code,
                    'content'   => $message
                )
            );
    }

    /**
     * Get the controller method based on request method.
     *
     * @param \Slim\Http\Request
     * @return string
     */
    protected function getMethod(Request $request)
    {
        return strtolower($request->getMethod()) . self::METHOD_SUFFIX;
    }

    /**
     * Execute the requested method on the controller.
     *
     * @param string
     * @param array
     * @return mixed
     */
    protected function callAction($method, $arguments)
    {
        return call_user_func_array(array($this, $method), $arguments);
    }

    /**
     * Handle calls to undefined methods on the controller.
     *
     * @param string
     * @param array
     * @return \Slim\Http\Response
     */
    public function __call($name, $arguments)
    {
        $response = $this->getResponse();

        return $response->withStatus(405)->write('Method Not Allowed');
    }

    /**
     * @param int $statusCode
     * @return string
     */
    protected function getHTTPStatusCodeMessage($statusCode)
    {
        return (string) $this->codes[$statusCode];
    }

    /**
     * @param int $statusCode
     * @return string
     */
    protected function getApiStatusCodeMessage($statusCode)
    {
        return (string) $this->apiCodes[$statusCode];
    }

    /**
     * Usual HTTP response codes
     * @var array
     */
    protected $codes = array(
        100 => 'Continue',
        200 => 'OK',
        201 => 'Created',
        202 => 'Accepted',
        203 => 'Non-Authoritative Information',
        204 => 'No Content',
        205 => 'Reset Content',
        206 => 'Partial Content',
        300 => 'Multiple Choices',
        301 => 'Moved Permanently',
        302 => 'Found',
        303 => 'See Other',
        304 => 'Not Modified',
        305 => 'Use Proxy',
        307 => 'Temporary Redirect',
        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        409 => 'Conflict',
        410 => 'Gone',
        411 => 'Length Required',
        412 => 'Precondition Failed',
        413 => 'Request Entity Too Large',
        414 => 'Request-URI Too Long',
        415 => 'Unsupported Media Type',
        416 => 'Requested Range Not Satisfiable',
        417 => 'Expectation Failed',
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        503 => 'Service Unavailable'
    );

    /**
     * OkayCMS specific codes
     * @var array
     */
    protected $apiCodes = array(
        100404 => 'Brand search error. Not found',
        100204 => 'Brands filter cannot be a null reference',
        200404 => 'Product search error. Not found',
        300404 => 'Variant search error. Not found',
        400404 => 'Category search error. Not found',
        500404 => 'Auth token has expired or invalid. Go to login page and request new token',
        500200 => 'Auth token is valid',
        500500 => 'Error while generating token. Please try again later'
    );
}