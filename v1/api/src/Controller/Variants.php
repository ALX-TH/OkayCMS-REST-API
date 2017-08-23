<?php

namespace Application\Controller;

use Application\Model\VariantsModel;

/**
 * Class Variants
 * @package Application\Controller
 */
class Variants extends Controller
{

    /**
     * @var array of allowed filters \Okay\Variants
     */
    protected $allowed_filters = array('product_id', 'id', 'in_stock');

    /**
     * @url /rest/variants/product_id/{id}
     * @url /rest/variants/id/{id}
     * @url /rest/variants/in_stock/{0|1}
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

        $filter = $this->fetchAll($this->allowed_filters);
        $variants = $this->okay->variants->get_variants($filter);
        if(empty($variants)){
            return $this->handleResponse($this->HTTP_STATUS_CODE_404, $this->getApiStatusCodeMessage($this->API_STATUS_CODE_VARIANT_NOT_FOUND));
        }

        $result = array();
        foreach ($variants as $variant) {
            $variant_item = new VariantsModel(
                $variant->id,
                $variant->product_id,
                $variant->weight,
                $variant->price,
                $variant->compare_price,
                $variant->sku,
                $variant->stock,
                $variant->infinity,
                $variant->attachment,
                $variant->position,
                $variant->currency_id,
                $variant->feed,
                $variant->rate_from,
                $variant->rate_to,
                $variant->name,
                $variant->units
            );
            $result[] = $variant_item->getVariantObject();
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