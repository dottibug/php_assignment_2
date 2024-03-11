<?php
// -----------------------------------------------------------------------------------------------
// Add/Update Customer Page
// Depending on the action ('add' or 'update'), displays a form for entering customer information
//. If updating, the customer's information is pre-filled from the database. Input is validated
// and sent to the database in db_add_update_customer.php
// -----------------------------------------------------------------------------------------------

$action = filter_input(INPUT_POST, 'action');
$customerID = $customerID ?? filter_input(INPUT_POST, 'customerID');
$customer = $customer ?? [];

require_once '../database.php';

// Get countries from countries table
$query = 'SELECT * FROM countries';
$statement1 = $db->prepare($query);
$statement1->execute();
$countries = $statement1->fetchAll();
$statement1->closeCursor();

// Get customer from customers table
if ($action === 'update') {
    $query = 'SELECT * FROM customers 
    INNER JOIN countries 
        ON customers.countryCode = countries.countryCode 
         WHERE customerID = :customerID';
    $statement2 = $db->prepare($query);
    $statement2->bindValue(':customerID', $customerID);
    $statement2->execute();
    $customer = $statement2->fetch(PDO::FETCH_ASSOC);
    $statement2->closeCursor();
}

// COUNTRY DROPDOWN
require_once '../helpers/getSelectedCountry.php';
$selectedCountry = getSelectedCountry($action, $customer, $countries);
?>

<!doctype html>
<html lang="en">
<?php include_once '../view/head.html' ?>
<body>
<?php include_once '../view/header.php' ?>
<section>
    <h2><?php echo $action === 'add' ? 'Add/Update Customer' : 'View/Update Customer'; ?></h2>

    <form action="db_add_update_customer.php" method="post">
        <!-- FIRST NAME -->
        <div class="formLabelInput">
            <?php $value = $action === 'update' ? ($firstName ?? $customer['firstName']) :
                ($firstName ?? ''); ?>
            <label for="firstName">First Name:</label>
            <input type="text" name="firstName" id="firstName" value="<?php echo htmlspecialchars
            ($value); ?>">
            <!-- Conditionally render error message -->
            <?php if (isset($errors['firstName'])) : ?>
                <p class="error"><?php echo $errors['firstName']; ?></p>
            <?php endif; ?>
        </div>

        <!-- LAST NAME -->
        <div class="formLabelInput">
            <?php $value = $action === 'update' ? ($lastName ?? $customer['lastName']) :
                ($lastName ?? ''); ?>
            <label for="lastName">Last Name:</label>
            <input type="text" name="lastName" id="lastName" value="<?php echo htmlspecialchars
            ($value); ?>">
            <!-- Conditionally render error message -->
            <?php if (isset($errors['lastName'])) : ?>
                <p class="error"><?php echo $errors['lastName']; ?></p>
            <?php endif; ?>
        </div>

        <!-- ADDRESS -->
        <div class="formLabelInput">
            <?php $value = $action === 'update' ? ($address ?? $customer['address']) :
                ($address ?? ''); ?>
            <label for="address">Address:</label>
            <input type="text" name="address" id="address" value="<?php echo htmlspecialchars
            ($value); ?>">
            <!-- Conditionally render error message -->
            <?php if (isset($errors['address'])) : ?>
                <p class="error"><?php echo $errors['address']; ?></p>
            <?php endif; ?>
        </div>

        <!-- CITY -->
        <div class="formLabelInput">
            <?php $value = $action === 'update' ? ($city ?? $customer['city']) :
                ($city ?? ''); ?>
            <label for="city">City:</label>
            <input type="text" name="city" id="city" value="<?php echo htmlspecialchars
            ($value); ?>">
            <!-- Conditionally render error message -->
            <?php if (isset($errors['city'])) : ?>
                <p class="error"><?php echo $errors['city']; ?></p>
            <?php endif; ?>
        </div>

        <!-- STATE -->
        <div class="formLabelInput">
            <?php $value = $action === 'update' ? ($state ?? $customer['state']) :
                ($state ?? ''); ?>
            <label for="state">State:</label>
            <input type="text" name="state" id="state" value="<?php echo htmlspecialchars
            ($value); ?>">
            <!-- Conditionally render error message -->
            <?php if (isset($errors['state'])) : ?>
                <p class="error"><?php echo $errors['state']; ?></p>
            <?php endif; ?>
        </div>


        <!-- POSTAL CODE -->
        <div class="formLabelInput">
            <?php $value = $action === 'update' ? ($postalCode ?? $customer['postalCode']) :
                ($postalCode ?? ''); ?>
            <label for="postalCode">Postal Code:</label>
            <input type="text" name="postalCode" id="postalCode" value="<?php echo htmlspecialchars
            ($value); ?>">
            <!-- Conditionally render error message -->
            <?php if (isset($errors['postalCode'])) : ?>
                <p class="error"><?php echo $errors['postalCode']; ?></p>
            <?php endif; ?>
        </div>

        <!-- COUNTRY -->
        <div class="formLabelInput">
            <label for="countryCode">Country:</label>
            <select name="countryCode" id="countryCode">
                <?php foreach ($countries as $country) : ?>
                    <option value="<?php echo $country['countryCode']; ?>"
                        <?php echo $country['countryName'] === $selectedCountry ? 'selected' : ''; ?>>
                        <?php echo $country['countryName']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- PHONE -->
        <div class="formLabelInput">
            <?php $value = $action === 'update' ? ($phone ?? $customer['phone']) :
                ($phone ?? ''); ?>
            <label for="phone">Phone:</label>
            <input type="text" name="phone" id="phone" value="<?php echo htmlspecialchars
            ($value); ?>">
            <!-- Conditionally render error message -->
            <?php if (isset($errors['phone'])) : ?>
                <p class="error"><?php echo $errors['phone']; ?></p>
            <?php endif; ?>
        </div>

        <!-- EMAIL -->
        <div class="formLabelInput">
            <?php $value = $action === 'update' ? ($email ?? $customer['email']) :
                ($email ?? ''); ?>
            <label for="email">Email:</label>
            <input type="text" name="email" id="email" value="<?php echo htmlspecialchars
            ($value); ?>">
            <!-- Conditionally render error message -->
            <?php if (isset($errors['email'])) : ?>
                <p class="error"><?php echo $errors['email']; ?></p>
            <?php endif; ?>
        </div>

        <!-- PASSWORD -->
        <div class="formLabelInput">
            <?php $value = $action === 'update' ? ($password ?? $customer['password']) :
                ($password ?? ''); ?>
            <label for="password">Password:</label>
            <input type="text" name="password" id="password" value="<?php echo htmlspecialchars
            ($value); ?>">
            <!-- Conditionally render error message -->
            <?php if (isset($errors['password'])) : ?>
                <p class="error"><?php echo $errors['password']; ?></p>
            <?php endif; ?>
        </div>

        <!-- BUTTON -->
        <?php if ($action === 'add') : ?>
            <input type="hidden" name="action" value="add">
            <input class="submitButtonIndent" type="submit" value="Add Customer">
        <?php else : ?>
            <input type="hidden" name="customerID" value="<?php echo $customer['customerID']; ?>">
            <input type="hidden" name="action" value="update">
            <input class="submitButtonIndent" type="submit" value="Update Customer">
        <?php endif; ?>
    </form>

    <!-- CUSTOMER SEARCH LINK -->
    <a href="customer_manager.php">Search Customers</a>

</section>
<?php include_once '../view/footer.php' ?>
</body>
</html>
