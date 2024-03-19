<?php
// ------------------------------------------------------------------------------
// Represents a technician (uses a base class of Person)
// ------------------------------------------------------------------------------
require_once 'Person.php';

class Technician extends Person
{
    private $numberOfOpenIncidents;

    // ------------------------------------------------------------------------------
    // Constructor
    // ------------------------------------------------------------------------------
    public function __construct($firstName, $lastName, $email, $phone, $password, $numberOfOpenIncidents
    = 0)
    {
        $this->numberOfOpenIncidents = $numberOfOpenIncidents;
        parent::__construct($firstName, $lastName, $email, $phone, $password);
    }

    // ------------------------------------------------------------------------------
    // Getters
    // ------------------------------------------------------------------------------
    public function getNumberOfOpenIncidents()
    {
        return $this->numberOfOpenIncidents;
    }

    // ------------------------------------------------------------------------------
    // Setters
    // ------------------------------------------------------------------------------
    public function setNumberOfOpenIncidents($num)
    {
        $this->numberOfOpenIncidents = $num;
    }
}

?>