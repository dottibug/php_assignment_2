<?php include '../view/header.php'; ?>
    <h2>Add Technician</h2>
    <form action="index.php" method="post" id="add_technician_form">
        <input type="hidden" name="action" value="add_technician">

        <!-- First Name -->
        <div class="formLabelInput">
            <label for="firstName">First Name:</label>
            <input type="text" name="firstName" id="firstName"
                   value="<?php echo htmlspecialchars($firstName); ?>">
            <!-- Conditionally render error message -->
            <?php if ($form->getField('firstName')->hasError()) : ?>
                <?php echo $form->getField('firstName')->getErrorHTML(); ?>
            <?php endif; ?>
        </div>

        <!-- Last Name -->
        <div class="formLabelInput">
            <label for="lastName">Last Name:</label>
            <input type="text" name="lastName" id="lastName"
                   value="<?php echo htmlspecialchars($lastName); ?>">
            <!-- Conditionally render error message -->
            <?php if ($form->getField('lastName')->hasError()) : ?>
                <?php echo $form->getField('lastName')->getErrorHTML() ?>
            <?php endif; ?>
        </div>

        <!-- Email -->
        <div class="formLabelInput">
            <label for="email">Email:</label>
            <input type="text" name="email" id="email"
                   value="<?php echo htmlspecialchars($email); ?>">
            <!-- Conditionally render error message -->
            <?php if ($form->getField('email')->hasError()) : ?>
                <?php echo $form->getField('email')->getErrorHTML() ?>
            <?php endif; ?>
        </div>

        <!-- Phone -->
        <div class="formLabelInput">
            <label for="phone">Phone:</label>
            <input type="text" name="phone" id="phone"
                   value="<?php echo htmlspecialchars($phone); ?>">
            <!-- Render phone format message (if no error) -->
            <?php if (!$form->getField('phone')->hasError()) : ?>
                <p class="tipMessage"><?php echo $form->getField('phone')->getMessage(); ?></p>
            <?php endif; ?>
            <!-- Conditionally render error message -->
            <?php if ($form->getField('phone')->hasError()) : ?>
                <?php echo $form->getField('phone')->getErrorHTML() ?>
            <?php endif; ?>
        </div>

        <!-- Password -->
        <div class="formLabelInput">
            <label for="password">Password:</label>
            <input type="text" name="password" id="password"
                   value="<?php echo htmlspecialchars($password); ?>">
            <!-- Conditionally render error message -->
            <?php if ($form->getField('password')->hasError()) : ?>
                <?php echo $form->getField('password')->getErrorHTML() ?>
            <?php endif; ?>
        </div>

        <!-- Submit -->
        <input class="submitButtonIndent" type="submit" value="Add Technician">
    </form>
    <br>

    <!-- Tech page link -->
    <a href="index.php?action=list_technicians">View Technician List</a>
<?php include_once '../view/footer.php'; ?>