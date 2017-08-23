<?php

namespace Application\Controller;

/**
 * Class Auth
 * @package Application\Controller
 */
class Auth extends Controller
{
    /**
     *
     * @param \Slim\Http\Request
     * @param \Slim\Http\Response
     * @return string
     */
    protected function getAction($request, $response)
    {
        return $this->validateToken();
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