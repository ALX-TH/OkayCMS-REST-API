<?php

namespace Application\Controller;
use Application\Model\ProductModel;

/**
 * Class Product
 * @package Application\Controller
 */
class Product extends Controller
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
     * @url /rest/product/{url}
     * @url /rest/product/{id}
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
            return $this->handleResponse($this->HTTP_STATUS_CODE_204, $this->getApiStatusCodeMessage($this->API_STATUS_CODE_PRODUCT_NULL_FILTER ));
        }

        $product = $this->okay->products->get_product($filter);
        if(is_null($product)){
            return $this->handleResponse($this->HTTP_STATUS_CODE_404, $this->getApiStatusCodeMessage($this->API_STATUS_CODE_PRODUCT_NOT_FOUND));
        }

        $result = array();
        $product_item = new ProductModel(
            $product->id,
            $product->url,
            $product->brand_id,
            $product->position,
            $product->created,
            $product->visible,
            $product->featured,
            $product->rating,
            $product->votes,
            $product->last_modify,
            $product->name,
            $product->meta_title,
            $product->meta_keywords,
            $product->meta_description,
            $product->annotation,
            $product->description,
            $product->special
        );
        $result[] = $product_item->getProductObject();
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