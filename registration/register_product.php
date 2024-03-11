<?php
// -----------------------------------------------------------------------------------------------
// Register Product
// The main interface for customers to register products. The user can login via email. Once
// logged in, the user can choose from a list of products to register, which is then added to the
// database via db_register.php
// -----------------------------------------------------------------------------------------------

// Database connection
require_once '../database.php';

// Initial values
$showLogin = true;
$email = filter_input(INPUT_POST, 'email');
$errors = array('email' => null, 'login' => null);

if ($email) {
    // Validate email
    require '../helpers/validEmail.php';
    $errors['email'] = validEmail($email);

    if (!$errors['email']) {
        // Get customer by email
        $query = 'SELECT * FROM customers WHERE email = :email';
        $statement = $db->prepare($query);
        $statement->bindValue(':email', $email);
        $statement->execute();
        $customer = $statement->fetch();
        $statement->closeCursor();

        // Display error message if customer not found
        if (!$customer) {
            $errors['login'] = 'No customer results. Try again.';
        } else {
            $showLogin = false;
        }
    }
}

if (!$showLogin) {
    $customerName = $customer['firstName'] . ' ' . $customer['lastName'];

    // Get products
    $query = 'SELECT * FROM products';
    $statement = $db->prepare($query);
    $statement->execute();
    $products = $statement->fetchAll(PDO::FETCH_ASSOC,);
    $statement->closeCursor();

    if (!$products) {
        $error_message = 'There was an error getting the products.';
        include '../database_error.php';
    }
}

?>

<!doctype html>
<html lang="en">
<?php include_once '../view/head.html'; ?>
<body>
<?php include_once '../view/header.php'; ?>

<section>
    <!-- CUSTOMER LOGIN -->
    <?php if ($showLogin) : ?>
        <h2>Customer Login</h2>
        <p class="instructions">You must log in before you can register a product.</p>

        <form action="" method="post">
            <div class="formLabelInput">
                <label for="email">Email:</label>
                <input type="text" name="email" id="email"
                       value="<?php echo htmlspecialchars($email ?? ''); ?>">
                <!-- Conditionally render email or login error -->
                <?php if (isset($errors['email']) || isset($errors['login'])) : ?>
                    <p class="error"><?php echo $errors['email'] ?: $errors['login']; ?></p>
                <?php endif; ?>
            </div>
            <input class="submitButtonIndent" type="submit">
        </form>
    <?php endif; ?>

    <!-- REGISTER PRODUCT -->
    <?php if (!$showLogin) : ?>
        <h2>Register Product</h2>

        <form action="db_register.php" method="post">
            <div class="formLabelInput">
                <label for="customer">Customer:</label>
                <p><?php echo htmlspecialchars($customerName); ?></p>
            </div>

            <div class="formLabelInput">
                <label for="product">Product:</label>
                <select name="productCode" id="productCode">
                    <?php foreach ($products as $product) : ?>
                        <option value="<?php echo $product['productCode']; ?>"><?php echo
                            $product['name'];
                            ?></option>
                    <?php endforeach; ?>
                </select>

            </div>
            <input type="hidden" name="customerID" value="<?php echo $customer['customerID']; ?>">
            <input class="submitButtonIndent" type="submit" value="Register Product">
        </form>
    <?php endif; ?>

</section>
<?php include_once '../view/footer.php'; ?>
</body>
</html>