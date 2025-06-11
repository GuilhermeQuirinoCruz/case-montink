<?php

class Product
{
    private $id;
    private $name;
    private $price;
    private $variations;
    private $stock;

    function __construct($id, $name, $price, $variations, $stock)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->variations = $variations;
        $this->stock = $stock;
    }

    function getId()
    {
        return $this->id;
    }

    function setId($id)
    {
        $this->id = $id;
    }

    function getName()
    {
        return $this->name;
    }

    function setName($name)
    {
        $this->name = $name;
    }

    function getPrice()
    {
        return $this->price;
    }

    function setPrice($price)
    {
        $this->price = $price;
    }

    function getVariations()
    {
        return $this->variations;
    }

    function setVariations($variations)
    {
        $this->variations = $variations;
    }

    function getStock()
    {
        return $this->stock;
    }

    function setStock($stock)
    {
        $this->stock = $stock;
    }
}
