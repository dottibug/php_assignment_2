<?php
// ------------------------------------------------------------------------------
// Represents a customer (base class is Person)
// ------------------------------------------------------------------------------
require_once 'Person.php';

class Customer extends Person
{
    private $address, $city, $state, $postalCode, $countryCode;

    // ------------------------------------------------------------------------------
    // Connector
    // ------------------------------------------------------------------------------
    public function __construct($firstName, $lastName, $email, $phone, $password, $address,
                                $city, $state, $postalCode, $countryCode)
    {
        $this->address = $address;
        $this->city = $city;
        $this->state = $state;
        $this->postalCode = $postalCode;
        $this->countryCode = $countryCode;
        parent::__construct($firstName, $lastName, $email, $phone, $password);
    }

    // ------------------------------------------------------------------------------
    // Getters
    // ------------------------------------------------------------------------------
    public function getAddress()
    {
        return $this->address;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function getState()
    {
        return $this->state;
    }

    public function getPostalCode()
    {
        return $this->postalCode;
    }

    public function getCountryCode()
    {
        return $this->countryCode;
    }


    // ------------------------------------------------------------------------------
    // Setters
    // ------------------------------------------------------------------------------
    public function setAddress($address)
    {
        $this->address = $address;
    }

    public function setCity($city)
    {
        $this->city = $city;
    }

    public function setState($state)
    {
        $this->state = $state;
    }

    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;
    }

    public function setCountryCode($countryCode)
    {
        $this->countryCode = $countryCode;
    }
}

?>