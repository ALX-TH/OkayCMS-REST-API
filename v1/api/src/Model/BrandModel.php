<?php

namespace Application\Model;

/**
 * Class BrandModel
 * @package Application\Model
 */
class BrandModel extends Model
{

    /**
     * BrandModel id
     * @var int
     * @access private
     */
    private $id;

    /**
     * BrandModel url
     * @var string
     * @access private
     */
    private $url;

    /**
     * BrandModel image
     * @var string
     * @access private
     */
    private $image;

    /**
     * BrandModel last modify
     * @var string
     * @access private
     */
    private $last_modify;

    /**
     * BrandModel visiblity
     * @var int
     * @access private
     */
    private $visible;

    /**
     * BrandModel position
     * @var int
     * @access private
     */
    private $position;

    /**
     * BrandModel name
     * @var string
     * @access private
     */
    private $name;

    /**
     * BrandModel page meta title
     * @var string
     * @access private
     */
    private $meta_title;

    /**
     * BrandModel meta keywords
     * @var string
     * @access private
     */
    private $meta_keywords;

    /**
     * BrandModel page meta description
     * @var string
     * @access private
     */
    private $meta_description;

    /**
     * BrandModel annotation
     * @var string
     * @access private
     */
    private $annotation;

    /**
     * BrandModel description
     * @var string
     * @access private
     */
    private $description;

    /**
     * BrandModel constructor.
     * @param $id
     * @param $url
     * @param $image
     * @param $last_modify
     * @param $visible
     * @param $position
     * @param $name
     * @param $meta_title
     * @param $meta_keywords
     * @param $meta_description
     * @param $annotation
     * @param $description
     */
    public function __construct($id, $url, $image, $last_modify, $visible, $position,
                                $name, $meta_title, $meta_keywords, $meta_description, $annotation, $description)
    {
        $this->id               = $id;
        $this->url              = $url;
        $this->image            = $image;
        $this->last_modify      = $last_modify;
        $this->visible          = $visible;
        $this->position         = $position;
        $this->name             = $name;
        $this->meta_title       = $meta_title;
        $this->meta_keywords    = $meta_keywords;
        $this->meta_description = $meta_description;
        $this->annotation       = $annotation;
        $this->description      = $description;
    }

    public function getBrandObject()
    {
        return array(
            'id'                => $this->getId(),
            'url'               => $this->getUrl(),
            'image'             => $this->getImage(),
            'last_modify'       => $this->getLastModify(),
            'visible'           => $this->getVisible(),
            'position'          => $this->getPosition(),
            'name'              => $this->getName(),
            'meta_title'        => $this->getMetaTitle(),
            'meta_keywords'     => $this->getMetaKeywords(),
            'meta_description'  => $this->getMetaDescription(),
            'annotation'        => $this->getAnnotation(),
            'description'       => $this->getDescription()
        );
    }

    /**
     * @return int
     */
    private function getId()
    {
        return (int) $this->id;
    }

    /**
     * @return string
     */
    private function getUrl()
    {
        return (string) $this->url;
    }

    /**
     * @return string
     */
    private function getImage()
    {
        return (string) $this->image;
    }

    /**
     * @return string
     */
    private function getLastModify()
    {
        return (string) $this->last_modify;
    }

    /**
     * @return int
     */
    private function getVisible()
    {
        return (int) $this->visible;
    }

    /**
     * @return int
     */
    private function getPosition()
    {
        return (int) $this->position;
    }

    /**
     * @return string
     */
    private function getName()
    {
        return (string) $this->name;
    }

    /**
     * @return string
     */
    private function getMetaTitle()
    {
        return (string) $this->meta_title;
    }

    /**
     * @return string
     */
    private function getMetaKeywords()
    {
        return (string) $this->meta_keywords;
    }

    /**
     * @return string
     */
    private function getMetaDescription()
    {
        return (string) $this->meta_description;
    }

    /**
     * @return string
     */
    private function getAnnotation()
    {
        return (string) $this->clearHtmlTags($this->annotation);
    }

    /**
     * @return string
     */
    private function getDescription()
    {
        return (string) $this->clearHtmlTags($this->description);
    }

}