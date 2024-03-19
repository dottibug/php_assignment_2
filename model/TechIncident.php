<?php

// ------------------------------------------------------------------------------
// Represents an incident for technicians
// ------------------------------------------------------------------------------

require_once 'Incident.php';

class TechIncident extends Incident
{
    private $customerName, $productName, $techName;

    // ------------------------------------------------------------------------------
    // Constructor
    // ------------------------------------------------------------------------------
    public function __construct($customerID, $productCode, $productName, $techID, $dateOpened,
                                $dateClosed, $title, $description, $customerName, $techName)
    {
        $this->customerName = $customerName;
        $this->productName = $productName;
        $this->techName = $techName;
        
        parent::__construct($customerID, $productCode, $techID, $dateOpened, $dateClosed, $title,
            $description);
    }

    // ------------------------------------------------------------------------------
    // Getters
    // ------------------------------------------------------------------------------
    public function getCustomerName()
    {
        return $this->customerName;
    }

    public function getProductName()
    {
        return $this->productName;
    }

    public function getTechName()
    {
        return $this->techName;
    }

    // ------------------------------------------------------------------------------
    // Setters
    // ------------------------------------------------------------------------------
    public function setCustomerName($name)
    {
        $this->customerName = $name;
    }

    public function setProductName($name)
    {
        $this->productName = $name;
    }

    public function setTechName($name)
    {
        $this->techName = $name;
    }
}

?>