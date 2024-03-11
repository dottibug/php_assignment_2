<?php
// -----------------------------------------------------------------------------------------------
// Customer Manager
// The main interface for managing customer info. Users can search for customers, see search
// results, and add new customers to the tech_support database.
// -----------------------------------------------------------------------------------------------

// Initial values
$errors = $errors ?? [];
$customers = $customers ?? false;

// Database connection
require_once '../database.php';

// Get Countries
$query = 'SELECT * FROM countries';
$statement = $db->prepare($query);
$statement->execute();
$countries = $statement->fetchAll();
$statement->closeCursor();

if (!$countries) {
    include_once '../database_error.php';
}

?>

<!doctype html>
<html lang="en">
<?php include_once '../view/head.html' ?>
<body>
<?php include_once '../view/header.php' ?>
<section>

    <!-- CUSTOMER SEARCH -->
    <?php include 'customer_search.php'; ?>
    <br>

    <!-- CUSTOMER RESULTS -->
    <?php if ($customers) : ?>
        <?php include 'customer_search_results.php'; ?>
    <?php endif; ?>

    <br>
    <!-- ADD CUSTOMER -->
    <h2>Add Customer</h2>
    <form action="add_update_customer.php" method="post">
        <input type="hidden" name="action" value="add">
        <input class="submitButtonNoIndent" type="submit" value="Add Customer">
    </form>
</section>
