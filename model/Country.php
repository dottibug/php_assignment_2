<?php
// ------------------------------------------------------------------------------
// Represents a country from the database
// ------------------------------------------------------------------------------
class Country
{
    private $countryCode, $countryName;

    // ------------------------------------------------------------------------------
    // Constructor
    // ------------------------------------------------------------------------------
    public function __construct($countryCode, $countryName)
    {
        $this->countryCode = $countryCode;
        $this->countryName = $countryName;
    }

    // ------------------------------------------------------------------------------
    // Getters
    // ------------------------------------------------------------------------------
    public function getCountryCode()
    {
        return $this->countryCode;
    }

    public function getCountryName()
    {
        return $this->countryName;
    }

    // ------------------------------------------------------------------------------
    // Setters
    // ------------------------------------------------------------------------------
    public function setCountryCode($code)
    {
        $this->countryCode = $code;
    }

    public function setCountryName($name)
    {
        $this->countryName = $name;
    }
}

?>