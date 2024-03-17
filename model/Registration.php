<?php
// ------------------------------------------------------------------------------
// Registration class. Represents the registration of a product by a customer.
// ------------------------------------------------------------------------------

class Registration
{
    private $customerID, $productCode, $name, $registrationDate;

    // ------------------------------------------------------------------------------
    // Constructor
    // ------------------------------------------------------------------------------
    public function __construct($customerID, $productCode, $name, $registrationDate)
    {
        $this->customerID = $customerID;
        $this->productCode = $productCode;
        $this->name = $name;
        $this->registrationDate = $registrationDate;
    }

    // ------------------------------------------------------------------------------
    // Setters
    // ------------------------------------------------------------------------------
    public function setCustomerID($customerID)
    {
        $this->customerID = $customerID;
    }

    public function setProductCode($productCode)
    {
        $this->productCode = $productCode;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setRegistrationDate($date)
    {
        $this->registrationDate = $date;
    }

    // ------------------------------------------------------------------------------
    // Getters
    // ------------------------------------------------------------------------------
    public function getCustomerID()
    {
        return $this->customerID;
    }

    public function getProductCode()
    {
        return $this->productCode;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getRegistrationDate()
    {
        return $this->registrationDate;
    }
}

?>