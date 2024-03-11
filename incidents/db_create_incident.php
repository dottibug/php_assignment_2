<?php
// -----------------------------------------------------------------------------------------------
// Database: Create Incident
// Validate user input from the create incident form (create_incident.php). Errors are added to
// an associative array, with the key representing the error type and the value containing the
// error message. If there are errors, the customer data is re-fetched and the create incident
// form is displayed again (including any error messages for the user to correct). If there are
// no errors, the incident is added to the database using the current date/time.
// -----------------------------------------------------------------------------------------------

// Database connection
require '../database.php';

// Helper functions
require_once '../helpers/emptyErrorArray.php';
require_once '../helpers/formatDateForDB.php';

$customerID = filter_input(INPUT_POST, 'customerID');
$productCode = filter_input(INPUT_POST, 'productCode');
$title = filter_input(INPUT_POST, 'title');
$description = filter_input(INPUT_POST, 'description');

$incidentErrors = array('title' => null, 'description' => null);

// Validate input
// TITLE: Check that title is not empty and has max 50 chars
if (!$title) {
    $incidentErrors['title'] = 'Required';
} elseif (strlen($title) > 50) {
    $incidentErrors['title'] = 'Must be 1 to 50 characters';
}

// DESCRIPTION: Check that description is not empty and has max 2000 chars
if (!$description) {
    $incidentErrors['description'] = 'Required';
} elseif (strlen($description) > 2000) {
    $incidentErrors['description'] = 'Must be 1 to 2000 characters';
}

// If there are form errors, refetch customer and display incident_create page
if (!emptyErrorArray($incidentErrors)) {
    $showGetCustomer = false;

    $query = "SELECT * FROM customers WHERE customerID = :customerID";
    $statement = $db->prepare($query);
    $statement->bindValue(':customerID', $customerID);
    $statement->execute();
    $customer = $statement->fetch(PDO::FETCH_ASSOC);
    $statement->closeCursor();

    include 'create_incident.php';
} else {
    // Create and format current date
    $dateObject = new DateTime('now');
    $dateOpen = formatDateForDB($dateObject);

// Add incident to database if no errors on form
    $query = 'INSERT INTO incidents VALUES(DEFAULT, :customerID, :productCode, NULL, :dateOpen, NULL, :title, :desc)';
    $statement = $db->prepare($query);
    $statement->bindValue(':customerID', $customerID);
    $statement->bindValue(':productCode', $productCode);
    $statement->bindValue(':dateOpen', $dateOpen);
    $statement->bindValue(':title', $title);
    $statement->bindValue(':desc', $description);
    $statement->execute();
    $statement->closeCursor();

    // Display success message
    $incidentAdded = true;
    include_once 'create_incident.php';
}
?>
