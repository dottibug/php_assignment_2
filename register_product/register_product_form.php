<?php include '../view/header.php'; ?>
<h2>Register Product</h2>

<form action="index.php" method="post" id="register_product_form">
    <input type="hidden" name="action" value="register_product">

    <!-- Customer -->
    <div class="formLabelInput">
        <label for="customer">Customer:</label>
        <p><?php echo htmlspecialchars($customer->getFullName()); ?></p>
    </div>

    <!-- Product Code -->
    <div class="formLabelInput">
        <label for="productCode">Product:</label>
        <select name="productCode" id="productCode">
            <?php foreach ($products as $product) : ?>
                <option value="<?php echo $product->getProductCode(); ?>">
                    <?php echo $product->getName(); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <!-- Submit -->
    <input class="submitButtonIndent" type="submit" value="Register Product">
</form>

<?php include 'login_info.php'; ?>

<?php include '../view/footer.php'; ?>
