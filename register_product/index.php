<?php
require_once '../model/Form.php';
require_once '../model/Validate.php';
require_once '../model/CustomerDB.php';
require_once '../model/ProductDB.php';
require_once '../model/RegistrationsDB.php';

const SHOW_LOGIN = 'show_login';
const LOGIN = 'login';
const REGISTER_PRODUCT = 'register_product';

// Get action type. Default action is show_login
$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL) {
        $action = SHOW_LOGIN;
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
    case(SHOW_LOGIN):
        $email = '';
        include 'customer_login_form.php';
        break;
    case (LOGIN):
        // Get form data
        $email = filter_input(INPUT_POST, 'email');

        // Validate form data
        $validate->email('email', $email, true);

        // Check if form has errors
        if ($form->hasErrors()) {
            include 'customer_login_form.php';
        } // If no errors, attempt login
        else {
            // Get customer by email
            $customer = CustomerDB::getCustomerByEmail($email);

            if (!$customer) {
                $form->getField('email')->setError('No customer results. Try again.');
                include 'customer_login_form.php';
            } else {
                $products = ProductDB::getProducts();
                include 'register_product_form.php';
            }
        }
        break;
    case (REGISTER_PRODUCT):
        // Get form data
        $productCode = filter_input(INPUT_POST, 'productCode');
        $customerID = filter_input(INPUT_POST, 'customerID');

        // Register product
        $registration = RegistrationsDB::registerProduct($productCode, $customerID);

//        var_dump($registration);

        // Display success message
        include 'registration_success.php';
        break;
}
?>