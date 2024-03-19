<?php include '../view/header.php'; ?>
<h2>Customer Login</h2>
<p class="instructions">You must log in before you can register a product.</p>

<form action="index.php" method="post" id="customer_login_form">
    <input type="hidden" name="action" value="login">

    <!-- Email -->
    <div class="formLabelInput">
        <label for="email">Email:</label>
        <input type="text" name="email" id="email" value="<?php echo $email; ?>">
        <!-- Conditional error message -->
        <?php if ($form->getField('email')->hasError()): ?>
            <?php echo $form->getField('email')->getErrorHTML(); ?>
        <?php endif; ?>
    </div>

    <!-- Password -->
    <div class="formLabelInput">
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" value="<?php echo $password; ?>">
        <!-- Conditional error message -->
        <?php if ($form->getField('password')->hasError()) : ?>
            <?php echo $form->getField('password')->getErrorHTML(); ?>
        <?php endif; ?>
    </div>

    <!-- Submit -->
    <input class="submitButtonIndent" type="submit" value="Login">
</form>
<?php include '../view/footer.php'; ?>
