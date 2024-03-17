<?php include '../view/header.php'; ?>
<h2>Customer Login</h2>
<p class="instructions">You must log in before you can register a product.</p>

<form action="index.php" method="post" id="customer_login_form">
    <input type="hidden" name="action" value="login">

    <label for="email">Email:</label>
    <div class="formLabelInput">
        <input type="text" name="email" id="email"
               value="<?php echo htmlspecialchars($email); ?>">
        <!-- Conditionally render email or login error -->
        <?php if ($form->getField('email')->hasError()) : ?>
            <?php echo $form->getField('email')->getErrorHTML(); ?>
        <?php endif; ?>
    </div>
    <input class="submitButtonNoIndent" type="submit">

</form>
<?php include '../view/footer.php'; ?>
