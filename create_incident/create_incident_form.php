<?php include '../view/header.php'; ?>
<h2>Create Incident</h2>

<form action="index.php" method="post" id="create_incident_form">
    <input type="hidden" name="action" value="create_incident">

    <!-- Customer Name -->
    <div class="formLabelInput">
        <label for="customer">Customer:</label>
        <p><?php echo $customer->getFullName(); ?></p>
    </div>

    <!-- Product Code -->
    <div class="formLabelInput">
        <label for="productCode">Product:</label>
        <select name="productCode" id="productCode">
            <?php foreach ($registrations as $registration) : ?>
                <option value="<?php echo $registration->getProductCode(); ?>">
                    <?php echo $registration->getName(); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <!-- Title -->
    <div class="formLabelInput">
        <label for="title">Title:</label>
        <input type="text" name="title" id="title"
               value="<?php echo htmlspecialchars($title); ?>">
        <!-- Conditionally render error -->
        <?php if ($form->getField('title')->hasError()) : ?>
            <?php echo $form->getField('title')->getErrorHTML(); ?>
        <?php endif; ?>
    </div>

    <!-- Description -->
    <div class="formLabelInput">
        <label for="description">Description:</label>
        <textarea name="description" id="description"
                  rows="5"><?php echo htmlspecialchars($description); ?></textarea>
        <!-- Conditionally render error -->
        <?php if ($form->getField('description')->hasError()) : ?>
            <?php echo $form->getField('description')->getErrorHTML(); ?>
        <?php endif; ?>
    </div>

    <!-- Button -->
    <input type="hidden" name="email" value="<?php echo $customer->getEmail(); ?>">
    <input class="submitButtonIndent" type="submit" value="Create Incident">
</form>

<?php include '../view/footer.php'; ?>
