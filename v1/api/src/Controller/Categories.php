<?php

namespace Application\Controller;
use Application\Model\CategoryModel;

/**
 * Class Categories
 * @package Application\Controller
 */
class Categories extends Controller
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
     * @var array of allowed filters \Okay\Categories
     */
    protected $allowed_filters = array('product_id', 'parent_id', 'level_depth');

    /**
     * @url rest/categoreies/
     * @url rest/categoreies/product_id/{id}
     * @url rest/categoreies/level_depth/{level}
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

        $categories = $this->okay->categories->get_categories($filter);
        if(empty($categories)){
            return $this->handleResponse($this->HTTP_STATUS_CODE_404, $this->getApiStatusCodeMessage($this->API_STATUS_CODE_CATEGORY_NOT_FOUND));
        }

        $result = array();
        foreach ($categories as $category) {
            $category_item = new CategoryModel(
                $category->id,
                $category->parent_id,
                $category->name,
                $category->meta_title,
                $category->url,
                $category->image,
                $category->level_depth
            );
            $result[] = $category_item->getCategoryObject();
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