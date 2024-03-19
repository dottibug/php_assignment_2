<?php
// ------------------------------------------------------------------------------
// Interacts with customers table
// ------------------------------------------------------------------------------
require_once 'Database.php';
require_once 'Customer.php';

class CustomersDB
{
    // ------------------------------------------------------------------------------
    // Get customer by last name
    // ------------------------------------------------------------------------------
    public function getCustomerByLastName($lastName)
    {
        try {
            $db = Database::getDB();
            $query = "SELECT * FROM customers WHERE lastName = :lastName";
            $statement = $db->prepare($query);
            $statement->bindValue(':lastName', $lastName);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
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
                    $customers[] = $customer;
                }
                return $customers;
            }
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            Database::displayDBError($error_message);
            return false;
        }
    }

    // ------------------------------------------------------------------------------
    // Get customer by id
    // ------------------------------------------------------------------------------
    public function getCustomerByID($id)
    {
        try {
            $db = Database::getDB();
            $query = "SELECT * FROM customers WHERE customerID = :id";
            $statement = $db->prepare($query);
            $statement->bindValue(':id', $id);
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);
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
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            Database::displayDBError($error_message);
            return false;
        }
    }

    // ------------------------------------------------------------------------------
    // Get customer by email
    // ------------------------------------------------------------------------------
    public function getCustomerByEmail($email)
    {
        try {
            $db = Database::getDB();
            $query = "SELECT * FROM customers WHERE email = :email";
            $statement = $db->prepare($query);
            $statement->bindValue(':email', $email);
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);
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
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            Database::displayDBError($error_message);
            return false;
        }
    }

    // ------------------------------------------------------------------------------
    // Add customer to customers table
    // ------------------------------------------------------------------------------
    public function addCustomer($customer)
    {
        try {
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
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $statement->closeCursor();

            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            Database::displayDBError($error_message);
            return false;
        }
    }

    // ------------------------------------------------------------------------------
    // Update customer
    // ------------------------------------------------------------------------------
    public function updateCustomer($customer)
    {
        try {
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
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $statement->closeCursor();
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            Database::displayDBError($error_message);
            return false;
        }
    }

    // ------------------------------------------------------------------------------
    // Checks if arguments match a valid customer from the customers table
    // ------------------------------------------------------------------------------
    public function validCustomer($email, $password)
    {
        try {
            $db = Database::getDB();
            $query = "SELECT password FROM customers WHERE email = :email";
            $statement = $db->prepare($query);
            $statement->bindValue(':email', $email);
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $statement->closeCursor();
            return $result !== false && $result['password'] === $password;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            Database::displayDBError($error_message);
            return false;
        }
    }
}

?>