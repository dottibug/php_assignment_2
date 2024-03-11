<?php
// -----------------------------------------------------------------------------------------------
// Customer Error
// Displayed to the user if they try to add a customer to the database that already exists.
// Provides a link and instructions for the user to return to the customer search page and choose
// to update a customer instead.
// -----------------------------------------------------------------------------------------------
?>

<!doctype html>
<html lang="en">
<?php include_once '../view/head.html' ?>
<body>
<?php include_once '../view/header.php' ?>
<section>
    <h2>Customer Already Exists</h2>
    <p>The customer already exists in the database.</p>
    <p>Return to the <a href="customer_manager.php">Customer
            Manager</a> page to search for and update a customer instead.</p>
</section>
<?php include_once '../view/footer.php' ?>
</body>
</html>