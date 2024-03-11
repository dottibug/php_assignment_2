<?php
// -----------------------------------------------------------------------------------------------
// Database: Add/Update Customer
// Validates user input (processed by validate_customer.php). If there are no errors in the
// errors array, the customer is added to or updated in the database based on the action ('add'
// or 'update'). If a customer is added that already exists, the user is sent to the Customer
// Error page (customer_error.php). Otherwise, the user is sent to the success page
// (add_updated_success.php)
// -----------------------------------------------------------------------------------------------

$action = filter_input(INPUT_POST, 'action');
$customerID = filter_input(INPUT_POST, 'customerID');
$firstName = filter_input(INPUT_POST, 'firstName');
$lastName = filter_input(INPUT_POST, 'lastName');
$address = filter_input(INPUT_POST, 'address');
$city = filter_input(INPUT_POST, 'city');
$state = filter_input(INPUT_POST, 'state');
$postalCode = filter_input(INPUT_POST, 'postalCode');
$countryCode = filter_input(INPUT_POST, 'countryCode');
$phone = filter_input(INPUT_POST, 'phone');
$email = filter_input(INPUT_POST, 'email');
$password = filter_input(INPUT_POST, 'password');

// VALIDATE CUSTOMER
include 'validate_customer.php';
require '../helpers/emptyErrorArray.php';

// Return to add/update customer page to display errors (if any errors)
if (!emptyErrorArray($errors)) {
    include 'add_update_customer.php';
    exit();
}

// ADD OR UPDATE CUSTOMER
// Database connection
require '../database.php';

// ADD customer to customers table
if ($action === 'add') {
    // Check if customer already exists is customers table
    $query = 'SELECT * FROM customers WHERE email = :email';
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->execute();
    $customerCount = $statement->fetch();
    $statement->closeCursor();

    // Display customer error page if customer already exists
    if ($customerCount > 0) {
        include 'customer_error.php';
        exit();
    }

    // Add customer to database
    $query = 'INSERT INTO customers VALUES (DEFAULT, :firstName, :lastName, :address, :city, 
                              :state, :postalCode, :countryCode, :phone, :email, :password)';
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
    $statement->closeCursor();
}

// UPDATE customer in customers table
if ($action === 'update') {
    $query = 'UPDATE customers
            SET firstName = :firstName, lastName = :lastName,
                address = :address, city = :city, state = :state, postalCode = :postalCode,
                countryCode = :countryCode, phone = :phone, email = :email, password = :password
            WHERE customerID = :customerID';
    $statement = $db->prepare($query);
    $statement->bindValue(':customerID', $customerID);
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
    $statement->closeCursor();
}

// Display success message
include 'add_update_success.php';
exit();
?>