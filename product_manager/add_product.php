<?php include '../view/header.php'; ?>
<h2>Add Product</h2>
<form action="index.php" method="post" id="add_product_form">
    <input type="hidden" name="action" value="add_product">

    <!-- PRODUCT CODE -->
    <div class="formLabelInput">
        <label for="productCode">Code:</label>
        <input type="text" name="productCode" id="productCode"
               value="<?php echo htmlspecialchars($productCode); ?>">
        <!-- Conditionally render error message -->
        <?php if ($form->getField('productCode')->hasError()) : ?>
            <?php echo $form->getField('productCode')->getErrorHTML(); ?>
        <?php endif; ?>
    </div>

    <!-- PRODUCT NAME -->
    <div class="formLabelInput">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name"
               value="<?php echo htmlspecialchars($name); ?>">
        <!-- Conditionally render error message -->
        <?php if ($form->getField('name')->hasError()) : ?>
            <?php echo $form->getField('name')->getErrorHTML(); ?>
        <?php endif; ?>
    </div>

    <!-- PRODUCT VERSION -->
    <div class="formLabelInput">
        <label for="version">Version:</label>
        <input type="text" name="version" id="version"
               value="<?php echo htmlspecialchars($version); ?>">
        <!-- Conditionally render error message -->
        <?php if ($form->getField('version')->hasError()) : ?>
            <?php echo $form->getField('version')->getErrorHTML(); ?>
        <?php endif; ?>
    </div>

    <!-- PRODUCT RELEASE -->
    <div class="formLabelInput">
        <label for="releaseDate">Release Date:</label>
        <input type="text" name="releaseDate" id="releaseDate"
               value="<?php echo htmlspecialchars($releaseDate); ?>">
        <!-- Render date format message (if no error) -->
        <?php if (!$form->getField('releaseDate')->hasError()) : ?>
            <p class="tipMessage"><?php echo $form->getField('releaseDate')->getMessage();
                ?></p>
        <?php endif; ?>
        <!-- Conditionally render error message -->
        <?php if ($form->getField('releaseDate')->hasError()) : ?>
            <?php echo $form->getField('releaseDate')->getErrorHTML(); ?>
        <?php endif; ?>
    </div>

    <!-- SUBMIT BUTTON -->
    <input class="submitButtonIndent" type="submit" value="Add Product">
</form>
<br>

<a href="index.php?action=list_products">View Product List</a>
<?php include '../view/footer.php'; ?>
