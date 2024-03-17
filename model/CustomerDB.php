<?php
// ------------------------------------------------------------------------------
// Interacts with customers table
// ------------------------------------------------------------------------------
require_once 'Database.php';
require_once 'Customer.php';

class CustomerDB
{
    // ------------------------------------------------------------------------------
    // Get customer by last name
    // ------------------------------------------------------------------------------
    public static function getCustomerByLastName($lastName)
    {
        $db = Database::getDB();

        $query = "SELECT * FROM customers WHERE lastName = :lastName";
        $statement = $db->prepare($query);
        $statement->bindValue(':lastName', $lastName);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();

        // Return false if customer not found
        if (!$result) {
            return false;
        } else {
            // Create array of Customer objects
            $customers = array();
            foreach ($result as $row) {
                $customer = new Customer(
                    $row['firstName'],
                    $row['lastName'],
                    $row['email'],
                    $row['phone'],
                    $row['password'],
                    $row['address'],
                    $row['city'],
                    $row['state'],
                    $row['postalCode'],
                    $row['countryCode']
                );
                $customer->setID($row['customerID']);
                $customers[] = $customer; // add new customer to customers array
            }
            return $customers;
        }
    }

    // ------------------------------------------------------------------------------
    // Get customer by id
    // ------------------------------------------------------------------------------
    public static function getCustomerByID($id)
    {
        $db = Database::getDB();

        $query = "SELECT * FROM customers WHERE customerID = :id";
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $id);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();

        // Create a new Customer object
        $customer = new Customer(
            $result['firstName'],
            $result['lastName'],
            $result['email'],
            $result['phone'],
            $result['password'],
            $result['address'],
            $result['city'],
            $result['state'],
            $result['postalCode'],
            $result['countryCode']
        );
        $customer->setID($result['customerID']);

        return $customer;
    }

    // ------------------------------------------------------------------------------
    // Get customer by email
    // ------------------------------------------------------------------------------
    public static function getCustomerByEmail($email)
    {
        $db = Database::getDB();

        $query = "SELECT * FROM customers WHERE email = :email";
        $statement = $db->prepare($query);
        $statement->bindValue(':email', $email);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();

        // Return false if customer not found
        if (!$result) {
            return false;
        } else {
            // Create a new Customer object
            $customer = new Customer(
                $result['firstName'],
                $result['lastName'],
                $result['email'],
                $result['phone'],
                $result['password'],
                $result['address'],
                $result['city'],
                $result['state'],
                $result['postalCode'],
                $result['countryCode']
            );
            $customer->setID($result['customerID']);

            return $customer;
        }
    }

    // ------------------------------------------------------------------------------
    // Add customer to customers table
    // ------------------------------------------------------------------------------
    public static function addCustomer($customer)
    {
        $db = Database::getDB();

        $firstName = $customer->getFirstName();
        $lastName = $customer->getLastName();
        $address = $customer->getAddress();
        $city = $customer->getCity();
        $state = $customer->getState();
        $postalCode = $customer->getPostalCode();
        $countryCode = $customer->getCountryCode();
        $phone = $customer->getPhone();
        $email = $customer->getEmail();
        $password = $customer->getPassword();

        $query = "INSERT INTO customers (firstName, lastName, address, city, state, postalCode, 
                      countryCode, phone, email, password) 
                    VALUES (:firstName, :lastName, :address, :city, :state, 
                           :postalCode, :countryCode, :phone, :email, :password)";
        $statement = $db->prepare($query);
        $statement->bindValue(':firstName', $firstName);
        $statement->bindValue(':lastName', $lastName);
        $statement->bindValue(':address', $address);
        $statement->bindValue(':city', $city);
        $statement->bindValue(':state', $state);
        $statement->bindValue(':postalCode', $postalCode);
        $statement->bindValue(':countryCode', $countryCode);
        $statement->bindValue(':phone', $phone);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':password', $password);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result;
    }

    // ------------------------------------------------------------------------------
    // Update customer
    // ------------------------------------------------------------------------------
    public static function updateCustomer($customer)
    {
        $db = Database::getDB();

        $firstName = $customer->getFirstName();
        $lastName = $customer->getLastName();
        $address = $customer->getAddress();
        $city = $customer->getCity();
        $state = $customer->getState();
        $postalCode = $customer->getPostalCode();
        $countryCode = $customer->getCountryCode();
        $phone = $customer->getPhone();
        $email = $customer->getEmail();
        $password = $customer->getPassword();
        $customerID = $customer->getID();

        $query = "UPDATE customers SET firstName = :firstName, lastName = :lastName,
                     address = :address, city=:city, state=:state,
                     postalCode = :postalCode, countryCode=:countryCode, phone=:phone,
                     email=:email, password=:password 
                     WHERE customerID = :customerID";

        $statement = $db->prepare($query);
        $statement->bindValue(':firstName', $firstName);
        $statement->bindValue(':lastName', $lastName);
        $statement->bindValue(':address', $address);
        $statement->bindValue(':city', $city);
        $statement->bindValue(':state', $state);
        $statement->bindValue(':postalCode', $postalCode);
        $statement->bindValue(':countryCode', $countryCode);
        $statement->bindValue(':phone', $phone);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':password', $password);
        $statement->bindValue(':customerID', $customerID);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result;
    }
}

?>