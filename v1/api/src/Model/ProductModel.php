<?php
namespace Application\Model;

/**
 * Class ProductModel
 * @package Application\Model
 */
class ProductModel extends Model
{
    /**
     * Product id
     * @var int
     * @access private
     */
    private $id;

    /**
     * Product url
     * @var string
     * @access private
     */
    private $url;

    /**
     * Product brand id
     * @var int
     * @access private
     */
    private $brand_id;

    /**
     * Product position
     * @var int
     * @access private
     */
    private $position;

    /**
     * Product created date
     * @var string
     * @access private
     */
    private $created;

    /**
     * Product is visible
     * @var int
     * @access private
     */
    private $visible;

    /**
     * Product is featured
     * @var int
     * @access private
     */
    private $featured;

    /**
     * Product rating
     * @var float
     * @access private
     */
    private $rating;

    /**
     * Product votes
     * @var int
     * @access private
     */
    private $votes;

    /**
     * Product last modify date
     * @var string
     * @access private
     */
    private $last_modify;

    /**
     * Product name
     * @var string
     * @access private
     */
    private $name;

    /**
     * Product page meta title
     * @var string
     * @access private
     */
    private $meta_title;

    /**
     * Product page meta keywords
     * @var string
     * @access private
     */
    private $meta_keywords;

    /**
     * Product page meta description
     * @var string
     * @access private
     */
    private $meta_description;

    /**
     * Product annotations
     * @var string
     * @access private
     */
    private $annotation;

    /**
     * Product description
     * @var string
     * @access private
     */
    private $description;

    /**
     * Product special
     * @var string
     * @access private
     */
    private $special;


    /**
     * ProductModel constructor.
     * @param $id
     * @param $url
     * @param $brand_id
     * @param $position
     * @param $created
     * @param $visible
     * @param $featured
     * @param $rating
     * @param $votes
     * @param $last_modify
     * @param $name
     * @param $meta_title
     * @param $meta_keywords
     * @param $meta_description
     * @param $annotation
     * @param $description
     * @param $special
     */
    public function __construct($id, $url, $brand_id, $position, $created, $visible, $featured, $rating, $votes, $last_modify,
                                    $name, $meta_title, $meta_keywords, $meta_description, $annotation, $description, $special)
    {
        $this->id               = $id;
        $this->url              = $url;
        $this->brand_id         = $brand_id;
        $this->position         = $position;
        $this->created          = $created;
        $this->visible          = $visible;
        $this->featured         = $featured;
        $this->rating           = $rating;
        $this->votes            = $votes;
        $this->last_modify      = $last_modify;
        $this->name             = $name;
        $this->meta_title       = $meta_title;
        $this->meta_keywords    = $meta_keywords;
        $this->meta_description = $meta_description;
        $this->annotation       = $annotation;
        $this->description      = $description;
        $this->special          = $special;
    }

    /**
     * Get product inforamtion
     * @return array
     */
    public function getProductObject()
    {
        return array(
            'id'                => $this->getId(),
            'url'               => $this->getUrl(),
            'brand_id'          => $this->getBrandId(),
            'position'          => $this->getPosition(),
            'created'           => $this->getCreated(),
            'visible'           => $this->getVisible(),
            'featured'          => $this->getFeatured(),
            'rating'            => $this->getRating(),
            'votes'             => $this->getVotes(),
            'last_modify'       => $this->getLastModify(),
            'name'              => $this->getName(),
            'meta_title'        => $this->getMetaTitle(),
            'meta_keywords'     => $this->getMetaKeywords(),
            'meta_description'  => $this->getMetaDescription(),
            'annotation'        => $this->getAnnotation(),
            'description'       => $this->getDescription(),
            'special'           => $this->getSpecial()
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
     * @return int
     */
    private function getBrandId()
    {
        return (int) $this->brand_id;
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
    private function getCreated()
    {
        return (string) $this->created;
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
    private function getFeatured()
    {
        return (int) $this->featured;
    }

    /**
     * @return float
     */
    private function getRating()
    {
        return (float) $this->rating;
    }

    /**
     * @return int
     */
    private function getVotes()
    {
        return (int) $this->votes;
    }

    /**
     * @return string
     */
    private function getLastModify()
    {
        return (string) $this->last_modify;
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

    /**
     * @return string
     */
    private function getSpecial()
    {
        return (string) $this->special;
    }

}