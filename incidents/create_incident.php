<?php
// -----------------------------------------------------------------------------------------------
// Create Incident
// The main interface for creating an incident. Users can find a customer by email. If the
// customer is found, the form to create an incident is displayed. When the form is submitted, a
// success message is displayed to the user. The form data is validated in db_create_incident.php
// -----------------------------------------------------------------------------------------------

require_once '../database.php';
$showGetCustomer = true;
$email = filter_input(INPUT_POST, 'email');
$customerErrors = array('email' => null, 'getCustomer' => null);
$incidentAdded = $incidentAdded ?? false;

if ($email) {
    // Validate email
    require_once '../helpers/validEmail.php';
    $customerErrors['email'] = validEmail($email);

    if (!$customerErrors['email']) {
        // Get customer by email
        $query = 'SELECT * FROM customers WHERE email = :email';
        $statement1 = $db->prepare($query);
        $statement1->bindValue(':email', $email);
        $statement1->execute();
        $customer = $statement1->fetch();
        $statement1->closeCursor();

        // Display error message if customer not found
        if (!$customer) {
            $customerErrors['getCustomer'] = 'No customer results. Try again.';
        } else {
            $showGetCustomer = false;
        }
    }
}

// If customer is found, get that customer's registered products
if (!$showGetCustomer) {
    $customerName = $customer['firstName'] . ' ' . $customer['lastName'];
    $customerID = $customer['customerID'];

    // Get customer's registered products
    $query = 'SELECT * FROM registrations 
    INNER JOIN products 
        ON registrations.productCode = products.productCode 
         WHERE customerID = :customerID';
    $statement2 = $db->prepare($query);
    $statement2->bindValue(':customerID', $customerID);
    $statement2->execute();
    $registrations = $statement2->fetchAll(PDO::FETCH_ASSOC,);
    $statement2->closeCursor();
}
?>

<!doctype html>
<html lang="en">
<?php include_once '../view/head.html' ?>
<body>
<?php include_once '../view/header.php' ?>

<section>
    <h2><?php echo $showGetCustomer ? 'Get Customer' : 'Create Incident'; ?></h2>

    <!-- GET CUSTOMER -->
    <?php if ($showGetCustomer) : ?>
        <p class="instructions">You must enter the customer's email address to select the
            customer.</p>

        <form action="" method="post">
            <div class="formLabelInput">
                <label for="email">Email:</label>
                <input type="text" name="email" id="email"
                       value="<?php echo htmlspecialchars($email ?? ''); ?>">
                <!-- Conditionally render email or getCustomer error -->
                <?php if (isset($customerErrors['email']) || isset($customerErrors['getCustomer'])) : ?>
                    <p class="error"><?php echo $customerErrors['email'] ?: $customerErrors['getCustomer'];
                        ?></p>
                <?php endif; ?>
            </div>
            <input class="submitButtonIndent" type="submit">
        </form>


        <!-- CREATE INCIDENT -->
    <?php elseif (!$showGetCustomer && !$incidentAdded) : ?>
        <form action="db_create_incident.php" method="post">
            <!-- Customer -->
            <div class="formLabelInput">
                <label for="customer">Customer:</label>
                <p><?php echo $customerName; ?></p>
            </div>

            <!-- Product code -->
            <div class="formLabelInput">
                <label for="productCode">Product:</label>
                <select name="productCode" id="productCode">
                    <?php foreach ($registrations as $reg) : ?>
                        <option value="<?php echo $reg['productCode']; ?>">
                            <?php echo $reg['name']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Title -->
            <div class="formLabelInput">
                <label for="title">Title:</label>
                <input type="text" name="title" id="title"
                       value="<?php echo htmlspecialchars($title ?? ''); ?>">
                <!-- Conditionally render error -->
                <?php if (isset($incidentErrors['title'])) : ?>
                    <p class="error"><?php echo $incidentErrors['title']; ?></p>
                <?php endif; ?>
            </div>

            <!-- Description -->
            <div class="formLabelInput">
                <label for="description">Description:</label>
                <textarea name="description" id="description"
                          rows="5"><?php echo htmlspecialchars($description ?? ''); ?></textarea>
                <!-- Conditionally render error -->
                <?php if (isset($incidentErrors['description'])) : ?>
                    <p class="error"><?php echo $incidentErrors['description'] ?></p>
                <?php endif; ?>
            </div>

            <input type="hidden" name="email" value="<?php echo $email; ?>">
            <input type="hidden" name="customerID" value="<?php echo $customerID; ?>">
            <input class="submitButtonIndent" type="submit" value="Create Incident">
        </form>
    <?php endif; ?>

    <?php if ($incidentAdded) : ?>
        <p>The incident was added to our database.</p>
    <?php endif; ?>

</section>

<?php include_once '../view/footer.php' ?>
</body>
</html>