<?php
// ------------------------------------------------------------------------------
// Abstract Person class (used as base for Customer and Technician classes)
// ------------------------------------------------------------------------------
abstract class Person
{
    private $id, $firstName, $lastName, $email, $phone, $password;

    // ------------------------------------------------------------------------------
    // Constructor
    // ------------------------------------------------------------------------------
    public function __construct($firstName, $lastName, $email, $phone, $password)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->phone = $phone;
        $this->password = $password;
    }

    // ------------------------------------------------------------------------------
    // Setters
    // ------------------------------------------------------------------------------
    public function setID($id)
    {
        $this->id = $id;
    }

    public function setFirstName($firstName)
    {
        return $this->firstName = $firstName;
    }

    public function setLastName($lastName)
    {
        return $this->lastName = $lastName;
    }

    public function setEmail($email)
    {
        return $this->email = $email;
    }

    public function setPhone($phone)
    {
        return $this->phone = $phone;
    }

    public function setPassword($password)
    {
        return $this->password = $password;
    }


    // ------------------------------------------------------------------------------
    // Getters
    // ------------------------------------------------------------------------------
    public function getID()
    {
        return $this->id;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function getFullName(): string
    {
        return $this->firstName . ' ' . $this->lastName;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function getPassword()
    {
        return $this->password;
    }
}

?>