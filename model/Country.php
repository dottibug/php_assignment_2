<?php

class Country
{
    private $countryCode, $countryName;

    public function __construct($countryCode, $countryName)
    {
        $this->countryCode = $countryCode;
        $this->countryName = $countryName;
    }

    public function getCountryCode()
    {
        return $this->countryCode;
    }

    public function getCountryName()
    {
        return $this->countryName;
    }

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