<?php

namespace Application\Controller;

use Application\Model\ProductModel;

/**
 * Class Products
 * @package Application\Controller
 */
class Products extends Controller
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
     * @var array of allowed filters \Okay\Products
     */
    protected $allowed_filters = array('limit', 'page', 'id', 'category_id', 'brand_id', 'featured', 'discounted', 'in_stock', 'has_images');

    /**
     * @url params limit={limit_on_page}
     * @url params page={page_number}
     *
     * @url rest/products/
     * @url rest/products/id/{id}
     * @url rest/products/category_id/{id}
     * @url rest/products/brand_id/{id}
     * @url rest/products/featured/{0|1}
     * @url rest/products/discounted/{0|1}
     * @url rest/products/in_stock/{0|1}
     * @url rest/products/has_images/{0|1}
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
        $filter = $this->fetchAll($this->allowed_filters);

        $products = $this->okay->products->get_products($filter);
        if(empty($products)){
            return $this->handleResponse($this->HTTP_STATUS_CODE_404, $this->getApiStatusCodeMessage($this->API_STATUS_CODE_PRODUCT_NOT_FOUND));
        }

        $result = array();
        foreach ($products as $product){
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
        }
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