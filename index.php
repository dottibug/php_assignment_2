<?php
// -----------------------------------------------------------------------------------------------
// COMP 3541 - Assignment 2, Part 2: SportsPro Tech Support
// Author: Tanya Woodside
// Date: March 11, 2024

// An app that tracks incidents with hypothetical software from SportsPro. Incidents are tracked
// in a database, along with customers, products, and technicians. Products can be added or
// deleted. Technicians can be added or deleted. Customers can be added or updated. Products can
// also be registered by customers, and technicians can create incident reports.
// -----------------------------------------------------------------------------------------------

?>

<!doctype html>
<html lang="en">
<?php include_once 'view/head.html' ?>

<body>
<?php include_once 'view/header.php' ?>

<section>
    <nav>
        <h2>Administrators</h2>
        <ul>
            <li><a href="products/product_manager.php">Manage Products</a></li>
            <li><a href="technicians/technician_manager.php">Manage Technicians</a></li>
            <li><a href="customers/customer_manager.php">Manage Customers</a></li>
            <li><a href="incidents/create_incident.php">Create Incident</a></li>
            <li><a href="under_construction.php">Assign Incident</a></li>
            <li><a href="under_construction.php">Display Incidents</a></li>
        </ul>

        <h2>Technicians</h2>
        <ul>
            <li><a href="under_construction.php">Update Incident</a></li>
        </ul>

        <h2>Customers</h2>
        <ul>
            <li><a href="registration/register_product.php">Register Product</a></li>
        </ul>
    </nav>
</section>

<?php include_once 'view/footer.php' ?>

</body>
</html>

