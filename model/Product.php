<?php
// ------------------------------------------------------------------------------
// Product class. Represents a product.
// ------------------------------------------------------------------------------
require_once 'Database.php';

class Product
{
    private $productCode, $name, $version, $releaseDate;

    // ------------------------------------------------------------------------------
    // Constructor
    // ------------------------------------------------------------------------------
    public function __construct($productCode, $name, $version, $releaseDate)
    {
        $this->productCode = $productCode;
        $this->name = $name;
        $this->version = $version;
        $this->releaseDate = $releaseDate;
    }

    // ------------------------------------------------------------------------------
    // Setters
    // ------------------------------------------------------------------------------
    public function setProductCode($value)
    {
        $this->productCode = $value;
    }

    public function setName($value)
    {
        $this->name = $value;
    }

    public function setVersion($value)
    {
        $this->version = $value;
    }

    public function setReleaseDate($value)
    {
        $this->releaseDate = $value;
    }

    // ------------------------------------------------------------------------------
    // Getters
    // ------------------------------------------------------------------------------
    public function getProductCode()
    {
        return $this->productCode;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getVersion()
    {
        return $this->version;
    }

    public function getReleaseDate()
    {
        return $this->releaseDate;
    }

    public function getFormattedReleaseDate()
    {
        $dateObject = new DateTime($this->releaseDate);
        return $dateObject->format('n/j/Y');
    }
}

?>