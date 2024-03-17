<?php include '../view/header.php'; ?>
<h2>Get Customer</h2>
<p class="instructions">You must enter the customer's email address to select the
    customer.</p>

<form action="index.php" method="post" id="customer_search_form">
    <input type="hidden" name="action" value="search">
    <div class="formLabelInput">
        <label for="email">Email:</label>
        <input type="text" name="email" id="email"
               value="<?php echo htmlspecialchars($email); ?>">
        <!-- Conditionally render error -->
        <?php if ($form->getField('email')->hasError()) : ?>
            <?php echo $form->getField('email')->getErrorHTML(); ?>
        <?php endif; ?>
    </div>
    <input class="submitButtonIndent" type="submit">
</form>
<?php include '../view/footer.php'; ?>
