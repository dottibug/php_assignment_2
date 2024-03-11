<?php
// -----------------------------------------------------------------------------------------------
// Database: Add Product
// Validates user input (processed by validate_product.php) from the add product form
// (add_product.php). Any errors are added to an associative array, with the key representing the
// error type and the value containing the error message. The add product form will display these
// errors for the user to correct. If there are no errors, the date is formatted for mySQL
// DATETIME data type and the product is added to the database.
// -----------------------------------------------------------------------------------------------

$code = filter_input(INPUT_POST, 'code');
$name = filter_input(INPUT_POST, 'name');
$version = filter_input(INPUT_POST, 'version');
$release = filter_input(INPUT_POST, 'release');

// Validate input
include 'validate_product.php';

// Helper functions
require '../helpers/emptyErrorArray.php';
require '../helpers/formatDateForDB.php';

if (!emptyErrorArray($errors)) {
    include 'add_product.php';
    exit();
} else {
    // Format date for mySQL
    $releaseDateObject = new DateTime($release);
    $release_f = formatDateForDB($releaseDateObject);

    // Add product to products table
    require_once '../database.php';
    $query = "INSERT INTO products VALUES (:code, :name, :version, :release)";
    $statement = $db->prepare($query);
    $statement->bindValue(':code', $code);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':version', $version);
    $statement->bindValue(':release', $release_f);
    $statement->execute();
    $statement->closeCursor();

    // Display product list
    include 'product_manager.php';
}
?>

