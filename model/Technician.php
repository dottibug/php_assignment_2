<?php

require_once 'Person.php';

class Technician extends Person
{
    public function __construct($firstName, $lastName, $email, $phone, $password)
    {
        parent::__construct($firstName, $lastName, $email, $phone, $password);
    }
}

?>