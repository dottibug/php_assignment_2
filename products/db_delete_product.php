<?php
// -----------------------------------------------------------------------------------------------
// Database: Delete Product
// Deletes product from the products table using the productCode. The product manager page is
// displayed after deletion.
// -----------------------------------------------------------------------------------------------

$productCode = filter_input(INPUT_POST, 'productCode');

// Database connection
require_once '../database.php';

// Delete the product from products table
$query = 'DELETE FROM products WHERE productCode = :productCode';
$statement = $db->prepare($query);
$statement->bindValue(':productCode', $productCode);
$statement->execute();
$statement->closeCursor();

// Display product list
include 'product_manager.php';
?>
