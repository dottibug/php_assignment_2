<?php

require_once 'Person.php';

class Customer extends Person
{
    private $address, $city, $state, $postalCode, $countryCode;

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

    // GETTERS
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


    // SETTERS
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