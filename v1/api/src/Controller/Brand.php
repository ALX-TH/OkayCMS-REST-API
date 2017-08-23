<?php
namespace Application\Controller;

use Application\Model\BrandModel;

/**
 * Class Brand
 * @package Application\Controller
 */
class Brand extends Controller
{
    /**
     * @var \Slim\Http\Request
     */
    protected $request;

    /**
     * @var \Slim\Http\Response
     */
    protected $response;

    /**
     * @url /rest/brand/{url}
     * @url /rest/brand/{id}
     *
     * @param \Slim\Http\Request
     * @param \Slim\Http\Response
     * @return string
     */
    protected function getAction($request, $response)
    {
        if(!$this->checkToken()){
            return $this->handleResponse($this->HTTP_STATUS_CODE_403, $this->getApiStatusCodeMessage($this->API_STATUS_CODE_TOKEN_IS_EXPIRED_OR_INVALID));
        }

        $this->request = $request;
        $this->response = $response;

        $filter = $this->fetchSingle();
        if(is_null($filter)) {
            return $this->handleResponse($this->HTTP_STATUS_CODE_204, $this->getApiStatusCodeMessage($this->API_STATUS_CODE_BRAND_NULL_FILTER));
        }

        $brand = $this->okay->brands->get_brand($filter);
        if(is_null($brand)){
            return $this->handleResponse($this->HTTP_STATUS_CODE_404, $this->getApiStatusCodeMessage($this->API_STATUS_CODE_BRAND_NOT_FOUND));
        }

        $result = array();
        $brand_item = new BrandModel(
                $brand->id,
                $brand->url,
                $brand->image,
                $brand->last_modify,
                $brand->visible,
                $brand->position,
                $brand->name,
                $brand->meta_title,
                $brand->meta_keywords,
                $brand->meta_description,
                $brand->annotation,
                $brand->description
        );
        $result[] = $brand_item->getBrandObject();
        return $this->handleResponse($this->HTTP_STATUS_CODE_200, $result);
    }

    /**
     *
     * @param \Slim\Http\Request
     * @param \Slim\Http\Response
     * @return string
     */
    protected function postAction($request, $response)
    {
        return $this->handleResponse($this->HTTP_STATUS_CODE_406, $this->getHTTPStatusCodeMessage($this->HTTP_STATUS_CODE_406));
    }


    /**
     *
     * @param \Slim\Http\Request
     * @param \Slim\Http\Response
     * @return string
     */
    protected function putAction($request, $response)
    {
        return $this->handleResponse($this->HTTP_STATUS_CODE_406, $this->getHTTPStatusCodeMessage($this->HTTP_STATUS_CODE_406));
    }

    /**
     *
     * @param \Slim\Http\Request
     * @param \Slim\Http\Response
     * @return string
     */
    protected function deleteAction($request, $response)
    {
        return $this->handleResponse($this->HTTP_STATUS_CODE_406, $this->getHTTPStatusCodeMessage($this->HTTP_STATUS_CODE_406));
    }

}