<?php
session_start();

// Required files
require_once '../model/Form.php';
require_once '../model/Validate.php';
require_once '../model/CustomersDB.php';
require_once '../model/ProductsDB.php';
require_once '../model/RegistrationsDB.php';

// Instantiate classes
$registrationsDB = new RegistrationsDB();
$productsDB = new ProductsDB();
$customersDB = new CustomersDB();

// Action variables
const SHOW_FORM = 'show_form';
const REGISTER_PRODUCT = 'register_product';
const LOGOUT = 'logout';

// Only allow access to valid customers
if (!$_SESSION['valid_customer']) {
    header("Location: ../customers");
    exit();
}

// Get action type. Default action is show_login
$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL) {
        $action = SHOW_FORM;
    }
}

// Set up form fields for login and product registration
$form = new Form();
$form->addField('email');
$form->addField('productName');

// Set up validation for form
$validate = new Validate($form);

// Controller
switch ($action) {
    case (SHOW_FORM):
        // Get customer by email
        $email = $_SESSION['customer_email'];
        $customer = $customersDB->getCustomerByEmail($email);
        $products = $productsDB->getProducts();
        include 'register_product_form.php';
        break;
    case (REGISTER_PRODUCT):
        // Get form data
        $productCode = filter_input(INPUT_POST, 'productCode');
        $customerID = $_SESSION['customerID'];

        // Register product
        $registration = $registrationsDB->registerProduct($productCode, $customerID);

        // Display success message
        include 'registration_success.php';
        break;
    case (LOGOUT):
        $_SESSION = array(); // Clear session data from memory
        session_destroy(); // Clean up session ID
        // Display customer login page
        header("Location: ../customers");
        break;
}
?>
