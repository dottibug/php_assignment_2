<?php
// -----------------------------------------------------------------------------------------------
// Database: Add Technician
// Validates user input (processed by validate_technician.php). Any errors are added to an associative array, with the key representing the
// error type and the value containing the error message. The add technician form will display these
// errors for the user to correct. If there are no errors, the technician is added to the database.
// -----------------------------------------------------------------------------------------------

$firstName = filter_input(INPUT_POST, 'firstName');
$lastName = filter_input(INPUT_POST, 'lastName');
$email = filter_input(INPUT_POST, 'email');
$phone = filter_input(INPUT_POST, 'phone');
$password = filter_input(INPUT_POST, 'password');

// Validate input
include 'validate_technician.php';
require '../helpers/emptyErrorArray.php';

// Check for errors. Add technician if there are no errors.
if (!emptyErrorArray($errors)) {
    include 'add_technician.php';
    exit();
} else {
    require_once '../database.php';

    $query = 'INSERT INTO technicians VALUES (DEFAULT, :firstName, :lastName, :email, :phone, :password)';
    $statement = $db->prepare($query);
    $statement->bindValue(':firstName', $firstName);
    $statement->bindValue(':lastName', $lastName);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':phone', $phone);
    $statement->bindValue(':password', $password);
    $statement->execute();
    $statement->closeCursor();

    // Display tech list
    include_once 'technician_manager.php';
}
?>