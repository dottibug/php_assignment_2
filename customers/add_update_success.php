<?php
// -----------------------------------------------------------------------------------------------
// Add/Update Success Page
// Displays a success message to the user when a customer was successfully added or updated to
// the database without any errors.
// -----------------------------------------------------------------------------------------------
?>
<!doctype html>
<html lang="en">
<?php include_once '../view/head.html' ?>
<body>
<?php include_once '../view/header.php' ?>
<section>
    <h2>Customer <?php echo $action === 'add' ? 'Added' : 'Updated'; ?> Successfully</h2>
    <div class="confirm_update">
        <a href="customer_manager.php">New Customer Search</a>
    </div>
</section>
<?php include_once '../view/footer.php' ?>
</body>
</html>