<?php

namespace Application\Model;

/**
 * Class Model
 * @package Application\Model
 */
abstract class Model
{

    /**
     * @param $string
     * @return mixed
     */
    protected function repleaceCommaToDot($string)
    {
        return str_replace(',', '.', $string);
    }

    /**
     * @param $string
     * @return string
     */
    protected function clearHtmlTags($string)
    {
        return strip_tags($string, "");
    }

    /**
     * @param $string
     * @return string
     */
    protected function stringToMd5($string)
    {
        return md5($string);
    }

    /**
     * @param $string
     * @return string
     */
    protected function stringToSha256($string)
    {
        return hash('sha256', $string);
    }

    protected function getDateWithOffset($offset)
    {
        return date("Y-m-d H:i:s", strtotime("+$offset sec"));
    }

}