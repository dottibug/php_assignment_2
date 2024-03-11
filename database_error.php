<!doctype html>
<html lang="en">
<?php include_once 'view/head.html' ?>

<body>
<?php include_once 'view/header.php' ?>

<section>
    <h2>Database Error</h2>
    <p>There was an error connecting to the database.</p>
    <p>Error Message: <?php echo $error_message; ?></p>
</section>

<?php include_once 'view/footer.php' ?>
</body>

</html>