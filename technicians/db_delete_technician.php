<?php
// -----------------------------------------------------------------------------------------------
// Database: Delete Product
// Delete technician from the technicians database
// -----------------------------------------------------------------------------------------------

$techID = filter_input(INPUT_POST, 'techID', FILTER_VALIDATE_INT);

// Database connection
require_once('../database.php');

// Delete technician from technicians table
$query = 'DELETE FROM technicians WHERE techID = :techID';
$statement = $db->prepare($query);
$statement->bindValue(':techID', $techID);
$statement->execute();
$statement->closeCursor();

// Display tech list
include_once 'technician_manager.php';
?>