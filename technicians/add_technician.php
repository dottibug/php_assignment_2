<?php
// -----------------------------------------------------------------------------------------------
// Add Technician
// Displays a form for adding a technician. Form submission is processed by db_add_technician.php
// -----------------------------------------------------------------------------------------------

$errors = $errors ?? false;
?>

<!doctype html>
<html lang="en">
<?php include_once '../view/head.html' ?>
<body>
<?php include_once '../view/header.php' ?>
<section>
    <h2>Add Technician</h2>
    <form action="db_add_technician.php" method="post">

        <!-- FIRST NAME -->
        <div class="formLabelInput">
            <label for="firstName">First Name:</label>
            <input type="text" name="firstName" id="firstName"
                   value="<?php echo htmlspecialchars($firstName ?? ''); ?>">
            <!-- Conditionally render error message -->
            <?php if (isset($errors['firstName'])) : ?>
                <p class="error"><?php echo $errors['firstName'] ?></p>
            <?php endif; ?>
        </div>

        <!-- LAST NAME -->
        <div class="formLabelInput">
            <label for="lastName">Last Name:</label>
            <input type="text" name="lastName" id="lastName"
                   value="<?php echo htmlspecialchars($lastName ?? ''); ?>">
            <!-- Conditionally render error message -->
            <?php if (isset($errors['lastName'])) : ?>
                <p class="error"><?php echo $errors['lastName'] ?></p>
            <?php endif; ?>
        </div>

        <!-- EMAIL -->
        <div class="formLabelInput">
            <label for="email">Email:</label>
            <input type="text" name="email" id="email"
                   value="<?php echo htmlspecialchars($email ?? ''); ?>">
            <!-- Conditionally render error message -->
            <?php if (isset($errors['email'])) : ?>
                <p class="error"><?php echo $errors['email'] ?></p>
            <?php endif; ?>
        </div>

        <!-- PHONE -->
        <div class="formLabelInput">
            <label for="phone">Phone:</label>
            <input type="text" name="phone" id="phone"
                   value="<?php echo htmlspecialchars($phone ?? ''); ?>">
            <!-- Conditionally render phone tip -->
            <?php if (!isset($errors['phone'])) : ?>
                <p id="phone_tip">Tel Format: 555-123-4567</p>
            <?php endif; ?>
            <!-- Conditionally render error message -->
            <?php if (isset($errors['phone'])) : ?>
                <p class="error"><?php echo $errors['phone'] ?></p>
            <?php endif; ?>
        </div>

        <!-- PASSWORD -->
        <div class="formLabelInput">
            <label for="password">Password:</label>
            <input type="text" name="password" id="password"
                   value="<?php echo htmlspecialchars($password ?? ''); ?>">
            <!-- Conditionally render error message -->
            <?php if (isset($errors['password'])) : ?>
                <p class="error"><?php echo $errors['password'] ?></p>
            <?php endif; ?>
        </div>

        <!-- SUBMIT BUTTON -->
        <input class="submitButtonIndent" type="submit" value="Add Technician">
    </form>
    <br>

    <!-- TECH PAGE LINK -->
    <a href="technician_manager.php">View Technician List</a>
</section>
<?php include_once '../view/footer.php' ?>
</body>
</html>