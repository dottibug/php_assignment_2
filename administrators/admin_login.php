<?php include '../view/header.php'; ?>
    <h2>Admin Login</h2>

    <form action="index.php" method="post" id="admin_login_form">
        <input type="hidden" name="action" value="login">

        <!-- Username -->
        <div class="formLabelInput">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" value="<?php echo $username; ?>">
            <!-- Conditional error message -->
            <?php if ($form->getField('username')->hasError()): ?>
                <?php echo $form->getField('username')->getErrorHTML(); ?>
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