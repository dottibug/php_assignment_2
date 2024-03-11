<?php
// -----------------------------------------------------------------------------------------------
// Add Product
// Displays a form to add a product to the database. Form submission is processed by
// db_add_product.php, which will add errors to an errors array to be displayed on this page if
// there are problems with the user input.
// -----------------------------------------------------------------------------------------------

$errors = $errors ?? false;
?>

<!doctype html>
<html lang="en">
<?php include_once '../view/head.html' ?>
<body>
<?php include_once '../view/header.php' ?>
<section>
    <h2>Add Product</h2>
    <form action="db_add_product.php" method="post">

        <!-- PRODUCT CODE -->
        <div class="formLabelInput">
            <label for="code">Code:</label>
            <input type="text" name="code" id="code"
                   value="<?php echo htmlspecialchars($code ?? ''); ?>">
            <!-- Conditionally render error message -->
            <?php if (isset($errors['code'])) : ?>
                <p class="error"><?php echo $errors['code'] ?></p>
            <?php endif; ?>
        </div>

        <!-- PRODUCT NAME -->
        <div class="formLabelInput">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name"
                   value="<?php echo htmlspecialchars($name ?? ''); ?>">
            <!-- Conditionally render error message -->
            <?php if (isset($errors['name'])) : ?>
                <p class="error"><?php echo $errors['name'] ?></p>
            <?php endif; ?>
        </div>

        <!-- PRODUCT VERSION -->
        <div class="formLabelInput">
            <label for="version">Version:</label>
            <input type="text" name="version" id="version"
                   value="<?php echo htmlspecialchars($version ?? ''); ?>">
            <!-- Conditionally render error message -->
            <?php if (isset($errors['version'])) : ?>
                <p class="error"><?php echo $errors['version'] ?></p>
            <?php endif; ?>
        </div>

        <!-- PRODUCT RELEASE -->
        <div class="formLabelInput">
            <label for="release">Release Date:</label>
            <input type="text" name="release" id="release"
                   value="<?php echo htmlspecialchars($release ?? ''); ?>">
            <!-- Conditionally render tip message -->
            <?php if (!isset($errors['release'])) : ?>
                <p id="date_tip">Use any valid date format</p>
            <?php endif; ?>
            <!-- Conditionally render error message -->
            <?php if (isset($errors['release'])) : ?>
                <p class="error"><?php echo $errors['release'] ?></p>
            <?php endif; ?>
        </div>

        <!-- SUBMIT BUTTON -->
        <input class="submitButtonIndent" type="submit" value="Add Product">
    </form>
    <br>

    <!-- PRODUCT PAGE LINK -->
    <a href="product_manager.php">View Product List</a>
</section>
<?php include_once '../view/footer.php' ?>
</body>
</html>