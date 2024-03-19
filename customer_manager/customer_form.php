<?php include '../view/header.php'; ?>
<h2><?php echo $formType === 'add' ? 'Add Customer' : 'View/Update Customer'; ?></h2>
<form action="index.php" method="post" id="add_update_customer">
    <input type="hidden" name="action"
           value="<?php echo $formType === 'add' ? 'add_customer' : 'update_customer'; ?>">
    
    <!-- First Name -->
    <div class="formLabelInput">
        <label for="firstName">First Name:</label>
        <input type="text" name="firstName" id="firstName" value="<?php echo htmlspecialchars
        ($firstName); ?>">
        <!-- Conditionally render error message -->
        <?php if ($form->getField('firstName')->hasError()) : ?>
            <?php echo $form->getField('firstName')->getErrorHTML(); ?>
        <?php endif; ?>
    </div>

    <!-- Last Name -->
    <div class="formLabelInput">
        <label for="lastName">Last Name:</label>
        <input type="text" name="lastName" id="lastName" value="<?php echo htmlspecialchars
        ($lastName); ?>">
        <!-- Conditionally render error message -->
        <?php if ($form->getField('lastName')->hasError()) : ?>
            <?php echo $form->getField('lastName')->getErrorHTML(); ?>
        <?php endif; ?>
    </div>

    <!-- Address -->
    <div class="formLabelInput">
        <label for="address">Address:</label>
        <input type="text" name="address" id="address" value="<?php echo htmlspecialchars
        ($address); ?>">
        <!-- Conditionally render error message -->
        <?php if ($form->getField('address')->hasError()) : ?>
            <?php echo $form->getField('address')->getErrorHTML(); ?>
        <?php endif; ?>
    </div>

    <!-- City -->
    <div class="formLabelInput">
        <label for="city">City:</label>
        <input type="text" name="city" id="city" value="<?php echo htmlspecialchars
        ($city); ?>">
        <!-- Conditionally render error message -->
        <?php if ($form->getField('city')->hasError()) : ?>
            <?php echo $form->getField('city')->getErrorHTML(); ?>
        <?php endif; ?>
    </div>

    <!-- State -->
    <div class="formLabelInput">
        <label for="state">State:</label>
        <input type="text" name="state" id="state" value="<?php echo htmlspecialchars
        ($state); ?>">
        <!-- Conditionally render error message -->
        <?php if ($form->getField('state')->hasError()) : ?>
            <?php echo $form->getField('state')->getErrorHTML(); ?>
        <?php endif; ?>
    </div>

    <!-- Postal Code -->
    <div class="formLabelInput">
        <label for="postalCode">Postal Code:</label>
        <input type="text" name="postalCode" id="postalCode" value="<?php echo htmlspecialchars
        ($postalCode); ?>">
        <!-- Conditionally render error message -->
        <?php if ($form->getField('postalCode')->hasError()) : ?>
            <?php echo $form->getField('postalCode')->getErrorHTML(); ?>
        <?php endif; ?>
    </div>

    <!-- Country -->
    <div class="formLabelInput">
        <label for="country">Country:</label>
        <select name="country" id="country">
            <?php foreach ($countries as $country) : ?>
                <option value="<?php echo $country->getCountryCode(); ?>"
                    <?php echo $country->getCountryName() === $selectedCountry ? 'selected' : ''; ?>>
                    <?php echo $country->getCountryName(); ?>
                </option>
            <?php endforeach; ?>
        </select>
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
    <?php if ($formType === 'update') : ?>
        <input type="hidden" name="customerID" value="<?php echo $customerID; ?>">
        <input type="hidden" name="originalCountryCode" value="<?php echo $originalCountryCode; ?>">
    <?php endif; ?>
    <input class="submitButtonIndent" type="submit" value="<?php echo $formType === 'add' ? 'Add '
        : 'Update '; ?>Customer">
</form>
<?php include '../view/footer.php'; ?>
