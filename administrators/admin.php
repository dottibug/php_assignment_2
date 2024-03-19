<?php include '../view/header.php'; ?>
<nav>
    <h2>Admin Menu</h2>
    <ul>
        <li><a href="../product_manager">Manage Products</a></li>
        <li><a href="../technician_manager">Manage Technicians</a></li>
        <li><a href="../customer_manager">Manage Customers</a></li>
        <li><a href="../create_incident">Create Incident</a></li>
        <li><a href="../assign_incident">Assign Incident</a></li>
        <li><a href="../display_incident">Display Incidents</a></li>
    </ul>
</nav>

<div class="loginStatus">
    <h2>Login Status</h2>
    <p>You are logged in as admin.</p>
    <form action="index.php" method="post" id="admin_logout">
        <input type="hidden" name="action" value="logout">
        <input class="submitButtonNoIndent" type="submit" value="Logout">
    </form>
</div>
<?php include '../view/footer.php'; ?>
