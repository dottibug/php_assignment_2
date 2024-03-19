<?php
// ------------------------------------------------------------------------------
// Registration class. Represents the registration of a product by a customer.
// ------------------------------------------------------------------------------

class Incident
{
    private $incidentID, $customerID, $productCode, $techID, $dateOpened, $dateClosed, $title,
        $description;

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
    public function setIncidentID($incidentID)
    {
        $this->incidentID = $incidentID;
    }

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
    public function getIncidentID()
    {
        return $this->incidentID;
    }

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
        if (!$this->dateOpened) {
            return null;
        } else {
            return $this->dateOpened;
        }
    }

    public function getFormattedDateOpened()
    {
        $dateObject = new DateTime($this->dateOpened);
        return $dateObject->format('n/j/Y');
    }

    public function getDateClosed()
    {
        if (!$this->dateClosed) {
            return null;
        } else {
            return $this->dateClosed;
        }
    }

    public function getFormattedDateClosed()
    {
        if (!$this->dateClosed) {
            return null;
        } else {
            $dateObject = new DateTime($this->dateClosed);
            return $dateObject->format('n/j/Y');
        }
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