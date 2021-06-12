<?php


class ApiItem
{
    public $code;
    public $name;
    public $barcode;
    public $itemType;
    public $unit;
    public $stock;
    public $buyPrice;
    public $sellPrice;
    public $purchaseTitle;
    public $salesTitle;
    public $nodeFamily;
    public $tag;
    public $active;

    public function __construct($code, $name)
    {
        $this->code = $code;
        $this->name = $name;
    }
}