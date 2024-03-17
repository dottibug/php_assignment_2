<?php
// ------------------------------------------------------------------------------
// Registration class. Represents the registration of a product by a customer.
// ------------------------------------------------------------------------------

class Incident
{
    private $customerID, $productCode, $techID, $dateOpened, $dateClosed, $title, $description;

    // ------------------------------------------------------------------------------
    // Constructor
    // ------------------------------------------------------------------------------
    public function __construct($customerID, $productCode, $techID, $dateOpened, $dateClosed,
                                $title, $description)
    {
        $this->customerID = $customerID;
        $this->productCode = $productCode;
        $this->techID = $techID;
        $this->dateOpened = $dateOpened;
        $this->dateClosed = $dateClosed;
        $this->title = $title;
        $this->description = $description;
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

    public function setTechID($techID)
    {
        $this->techID = $techID;
    }

    public function setDateOpened($dateOpened)
    {
        $this->dateOpened = $dateOpened;
    }

    public function setDateClosed($dateClosed)
    {
        $this->dateClosed = $dateClosed;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setDescription($description)
    {
        $this->description = $description;
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

    public function getTechID()
    {
        return $this->techID;
    }

    public function getDateOpened()
    {
        return $this->dateOpened;
    }

    public function getDateClosed()
    {
        return $this->dateClosed;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getDescription()
    {
        return $this->description;
    }
}

?>