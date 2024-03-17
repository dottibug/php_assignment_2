<?php include '../view/header.php'; ?>
<h2>Customer Search</h2>

<form action="index.php" method="post" id="customer_search_form">
    <input type="hidden" name="action" value="search">
    <div class="formLabelInput">
        <label for="lastName">Last Name:</label>
        <input type="text" name="lastName" id="lastName"
               value="<?php echo $lastName; ?>">

        <!-- Conditionally render error -->
        <?php if ($form->getField('lastName')->hasError()) : ?>
            <?php echo $form->getField('lastName')->getErrorHTML(); ?>
        <?php endif; ?>
    </div>
    <input class="submitButtonIndent" type="submit">
</form>

<!-- Conditionally render search results -->
<?php if ($showSearchResults): ?>
    <?php include 'search_results.php'; ?>
<?php endif; ?>

<br>
<h2>Add a New Customer</h2>
<form action="index.php" method="post">
    <input type="hidden" name="action" value="show_add_form">
    <input class="submitButtonNoIndent" type="submit" value="Add Customer">
</form>

<?php include '../view/footer.php'; ?>
