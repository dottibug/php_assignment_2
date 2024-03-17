<?php
// -----------------------------------------------------------------------------------------------
// COMP 3541 - Assignment 2, Part 2: SportsPro Tech Support
// Author: Tanya Woodside
// Date: March 11, 2024

// An app that tracks create_incident with hypothetical software from SportsPro. Incidents are tracked
// in a database, along with customer_manager, product_manager, and technician_manager. Products can be added or
// deleted. Technicians can be added or deleted. Customers can be added or updated. Products can
// also be registered by customer_manager, and technician_manager can create incident reports.
// -----------------------------------------------------------------------------------------------

?>

<?php include_once 'view/header.php' ?>
<nav>
    <h2>Administrators</h2>
    <ul>
        <li><a href="product_manager">Manage Products</a></li>
        <li><a href="technician_manager">Manage Technicians</a></li>
        <li><a href="customer_manager">Manage Customers</a></li>
        <li><a href="create_incident">Create Incident</a></li>
        <li><a href="under_construction.php">Assign Incident</a></li>
        <li><a href="under_construction.php">Display Incidents</a></li>
    </ul>

    <h2>Technicians</h2>
    <ul>
        <li><a href="under_construction.php">Update Incident</a></li>
    </ul>

    <h2>Customers</h2>
    <ul>
        <li><a href="register_product">Register Product</a></li>
    </ul>
</nav>
<?php include_once 'view/footer.php' ?>

