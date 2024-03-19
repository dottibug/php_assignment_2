<?php include '../view/header.php'; ?>
<h2>Assign Incident</h2>
<form action="index.php" method="post" id="assign">
    <input type="hidden" name="action" value="assign">

    <!-- Customer -->
    <div class="formLabelInput">
        <label for="customerName">Customer:</label>
        <p><?php echo $customer->getFullName(); ?></p>
    </div>

    <!-- Product -->
    <div class="formLabelInput">
        <label for="productCode">Product:</label>
        <p><?php echo $incident->getProductCode(); ?></p>
    </div>

    <!-- Technician -->
    <div class="formLabelInput">
        <label for="technician">Technician:</label>
        <p><?php echo $technician->getFullName(); ?></p>
    </div>
    
    <!-- Submit -->
    <input type="submit" value="Assign Incident" class="submitButtonNoIndent">
</form>
<?php include '../view/footer.php'; ?>
