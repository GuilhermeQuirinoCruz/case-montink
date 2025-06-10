<?php

class Product
{
    private $id;
    private $name;
    private $price;
    private $variations;

    function __construct($id, $name, $price, $variations)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->variations = $variations;
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
}
