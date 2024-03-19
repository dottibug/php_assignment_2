<?php
// Start session management with a session cookie and secure connection
session_set_cookie_params(0, '/', '', true);
session_start();

// Required files
require_once '../model/Form.php';
require_once '../model/Validate.php';
require_once '../model/CustomersDB.php';
require_once '../model/ProductsDB.php';

// Instantiate classes
$customersDB = new CustomersDB();

// Action variables
const SHOW_LOGIN = 'show_login';
const LOGIN = 'login';

// Create valid_customer cookie if it does not exist
if (!isset($_SESSION['valid_customer'])) {
    $_SESSION['valid_customer'] = false;
}

// Get action type. Default action is show_login
$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL) {
        $action = SHOW_LOGIN;
    }
}

// Set up form fields for logging in
$form = new Form();
$form->addField('email');
$form->addField('password');

// Set up validation for form
$validate = new Validate($form);

// Controller
switch ($action) {
    case (SHOW_LOGIN):
        // Skip login if valid customer has an existing session
        if (isset($_SESSION['valid_customer']) && $_SESSION['valid_customer']) {
            header("Location: ../register_product");
        } else {
            $email = '';
            $password = '';
            include 'customer_login.php';
        }
        break;
    case (LOGIN):
        // Get form data
        $email = filter_input(INPUT_POST, 'email');
        $password = filter_input(INPUT_POST, 'password');

        // Validate form data
        $validate->email('email', $email, true);
        $validate->text('password', $password, true, 1, 40);

        // Check if form has errors
        if ($form->hasErrors()) {
            include 'customer_login.php';
        } else {
            // Check if credentials match a customer
            $isValidCustomer = $customersDB->validCustomer($email, $password);
            // Show errors if invalid customer
            if (!$isValidCustomer) {
                $form->getField('email')->setError('Invalid email or password');
                $form->getField('password')->setError('Invalid email or password');
                include 'customer_login.php';
            } // If valid customer, regenerate session id, add valid_customer cookie, and
            // display register product page
            else {
                // Get customer object and store customerID in session cookie
                $_SESSION = array();
                $customer = $customersDB->getCustomerByEmail($email);
                $customerID = $customer->getID();
                session_regenerate_id();
                $_SESSION['valid_customer'] = true;
                $_SESSION['customer_email'] = $email;
                $_SESSION['customerID'] = $customerID;
                header("Location: ../register_product");
            }
        }
        break;
}
?>