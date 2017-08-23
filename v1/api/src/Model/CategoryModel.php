<?php
namespace Application\Model;

/**
 * Class CategoryModel
 * @package Application\Model
 */

class CategoryModel extends Model
{

    /**
     * Category id
     * @var int
     * @access private
     */
    private $id;

    /**
     * Category parent id
     * @var int
     * @access private
     */
    private $parent_id;

    /**
     * Category name
     * @var string
     * @access private
     */
    private $name;

    /**
     * Category meta title tag name
     * @var string
     * @access private
     */
    private $meta_title;

    /**
     * Category url
     * @var string
     * @access private
     */
    private $url;

    /**
     * Categoty image
     * @var string
     * @access private
     */
    private $image;

    /**
     * Categoty path-level depth
     * @var int
     * @access private
     */
    private $level_depth;

    /**
     * CategoryModel constructor.
     * @param int $id
     * @param int $parent_id
     * @param string $name
     * @param string $meta_title
     * @param string $url
     * @param string $image
     * @param int $level_depth
     */

    public function __construct($id, $parent_id, $name, $meta_title, $url, $image, $level_depth) {
        $this->id           = $id;
        $this->parent_id    = $parent_id;
        $this->name         = $name;
        $this->meta_title   = $meta_title;
        $this->url          = $url;
        $this->image        = $image;
        $this->level_depth  = $level_depth;
    }

    /**
     * Get categoty information
     * @return array
     */

    public function getCategoryObject () {
        return array (
            'id'            =>  $this->getId(),
            'parent_id'     =>  $this->getParentId(),
            'name'          =>  $this->getName(),
            'meta_title'    =>  $this->getMetaTitle(),
            'url'           =>  $this->getUrl(),
            'image'         =>  $this->getImage(),
            'level_depth'   =>  $this->getLevelDepth()
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
     * @return int
     */
    private function getParentId()
    {
        return (int) $this->parent_id;
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
     * @return int
     */
    private function getLevelDepth()
    {
        return (int) $this->level_depth;
    }



}