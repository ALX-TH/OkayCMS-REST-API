<?php

namespace Application\Model;

/**
 * Class VariantsModel
 * @package Application\Model
 */
class VariantsModel extends Model
{

    /**
     * Variant id
     * @var int
     * @access private
     */
    private $id;

    /**
     * Variant product id
     * @var int
     * @access private
     */
    private $product_id;

    /**
     * Variant weight
     * @var float
     * @access private
     */
    private $weight;

    /**
     * Variant price
     * @var int
     * @access private
     */
    private $price;

    /**
     * Variant compare price
     * @var int
     * @access private
     */
    private $compare_price;

    /**
     * Variant sku
     * @var string
     * @access private
     */
    private $sku;

    /**
     * Variant in stock count
     * @var int
     * @access private
     */
    private $stock;

    /**
     * Variant infinity
     * @var int
     * @access private
     */
    private $infinity;

    /**
     * Variant attachment
     * @var string
     * @access private
     */
    private $attachment;

    /**
     * Variant position
     * @var int
     * @access private
     */
    private $position;

    /**
     * Variant currency
     * @var int
     * @access private
     */
    private $currency_id;

    /**
     * Variant feed
     * @var int
     * @access private
     */
    private $feed;

    /**
     * Variant rate from
     * @var float
     * @access private
     */
    private $rate_from;

    /**
     * Variant rate to
     * @var float
     * @access private
     */
    private $rate_to;

    /**
     * Variant name
     * @var string
     * @access private
     */
    private $name;

    /**
     * Variant units, like kg
     * @var string
     * @access private
     */
    private $units;

    /**
     * VariantModel constructor.
     * @param $id
     * @param $product_id
     * @param $weight
     * @param $price
     * @param $compare_price
     * @param $sku
     * @param $stock
     * @param $infinity
     * @param $attachment
     * @param $position
     * @param $currency_id
     * @param $feed
     * @param $rate_from
     * @param $rate_to
     * @param $name
     * @param $units
     */
    public function __construct($id, $product_id, $weight, $price, $compare_price, $sku, $stock, $infinity,
                                $attachment, $position, $currency_id, $feed, $rate_from, $rate_to, $name, $units)
    {
        $this->id               = $id;
        $this->product_id       = $product_id;
        $this->weight           = $weight;
        $this->price            = $price;
        $this->compare_price    = $compare_price;
        $this->sku              = $sku;
        $this->stock            = $stock;
        $this->infinity         = $infinity;
        $this->attachment       = $attachment;
        $this->position         = $position;
        $this->currency_id      = $currency_id;
        $this->feed             = $feed;
        $this->rate_from        = $rate_from;
        $this->rate_to          = $rate_to;
        $this->name             = $name;
        $this->units            = $units;
    }

    public function getVariantObject()
    {
        return array(
            'id'            => $this->getId(),
            'product_id'    => $this->getVariantId(),
            'weight'        => $this->getVariantWeight(),
            'price'         => $this->getVarinatPrice(),
            'compare_price' =>  $this->getVariantComparePrice(),
            'sku'           => $this->getVariantSku(),
            'stock'         => $this->getVariantStock(),
            'infinity'      => $this->getVariantInfinity(),
            'attachment'    => $this->getVariantAttachment(),
            'position'      => $this->getVariantPosition(),
            'currency_id'   => $this->getVariantCurrencyId(),
            'feed'          => $this->getVariantFeed(),
            'rate_from'     => $this->getVariantRateFrom(),
            'rate_to'       => $this->getVariantRateTo(),
            'name'          => $this->getVariantName(),
            'units'         => $this->getVariantUnits()
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
    private function getVariantId()
    {
        return (int) $this->product_id;
    }

    /**
     * @return float
     */
    private function getVariantWeight()
    {
        return (float) $this->weight;
    }

    /**
     * @return float
     */
    private function getVarinatPrice()
    {
        return (float) $this->repleaceCommaToDot($this->price);
    }

    /**
     * @return float
     */
    private function getVariantComparePrice()
    {
        return (float) $this->repleaceCommaToDot($this->compare_price);
    }

    /**
     * @return string
     */
    private function getVariantSku()
    {
        return (string) $this->sku;
    }

    /**
     * @return int
     */
    private function getVariantStock()
    {
        return (int) $this->stock;
    }

    /**
     * @return int
     */
    private function getVariantInfinity()
    {
        return (int) $this->infinity;
    }

    /**
     * @return string
     */
    private function getVariantAttachment()
    {
        return (string) $this->attachment;
    }

    /**
     * @return int
     */
    private function getVariantPosition()
    {
        return (int) $this->position;
    }

    /**
     * @return int
     */
    private function getVariantCurrencyId()
    {
        return (int) $this->currency_id;
    }

    /**
     * @return int
     */
    private function getVariantFeed()
    {
        return (int) $this->feed;
    }

    /**
     * @return float
     */
    private function getVariantRateFrom()
    {
        return (float) $this->rate_from;
    }

    /**
     * @return float
     */
    private function getVariantRateTo()
    {
        return (float) $this->rate_to;
    }

    /**
     * @return string
     */
    private function getVariantName()
    {
        return (string) $this->name;
    }

    /**
     * @return string
     */
    private function getVariantUnits()
    {
        return (string) $this->units;
    }

}