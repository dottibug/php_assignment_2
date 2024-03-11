<?php
// -----------------------------------------------------------------------------------------------
// Validate Customer
// Validates the various customer input fields, ensuring they meet the database requirements.
// Stores any errors into an errors array that add_updated_customer.php uses to display helpful
// error messages to the user.
// -----------------------------------------------------------------------------------------------

// Email validation helper
require_once '../helpers/validEmail.php';

// Contains error messages for the related keys, if any. Used to show error messages on the
// add_update_view_customer form.
$errors = array('firstName' => null, 'lastName' => null, 'address' => null, 'city' => null, 'state' =>
    null, 'postalCode' => null, 'phone' => null, 'email' => null, 'password' => null);

// Error handling variables
const REQ = 'Required';
const MAX_50 = 'Must be 1 to 50 characters';
const MAX_20 = 'Must be 1 to 20 characters';
const PASSWORD_ERR = 'Must be 6 to 20 characters';
const PHONE_ERR = 'Tel Format: (999) 999-9999';

$emailError = validEmail($email);

// Validate phone format: (999) 999-9999
function validPhoneFormat($phone)
{
    $pattern = "/^\(\d{3}\) \d{3}-\d{4}$/";
    return preg_match($pattern, $phone);
}

// DATA VALIDATION
// FIRST NAME: Check that firstName is not empty and has max 50 chars
if (!$firstName) {
    $errors['firstName'] = REQ;
} elseif (strlen($firstName) > 50) {
    $errors['firstName'] = MAX_50;
}

// LAST NAME: Check that lastName is not empty and has max 50 chars
if (!$lastName) {
    $errors['lastName'] = REQ;
} elseif (strlen($lastName) > 50) {
    $errors['lastName'] = MAX_50;
}

// ADDRESS: Check that address is not empty and has max 50 chars
if (!$address) {
    $errors['address'] = REQ;
} elseif (strlen($address) > 50) {
    $errors['address'] = MAX_50;
}

// CITY: Check that city is not empty and has max 50 chars
if (!$city) {
    $errors['city'] = REQ;
} elseif (strlen($city) > 50) {
    $errors['city'] = MAX_50;
}

// STATE: Check that state is not empty and has max 50 chars
if (!$state) {
    $errors['state'] = REQ;
} elseif (strlen($state) > 50) {
    $errors['state'] = MAX_50;
}

// POSTAL CODE: Check that postal code is not empty and has max 20 chars
if (!$postalCode) {
    $errors['postalCode'] = REQ;
} elseif (strlen($postalCode) > 20) {
    $errors['postalCode'] = MAX_20;
}

// PHONE: Check that phone is not empty and matches (999) 999-9999 format
if (!$phone) {
    $errors['phone'] = REQ;
} elseif (!validPhoneFormat($phone)) {
    $errors['phone'] = PHONE_ERR;
}

// EMAIL: Check that email is not empty, has 50 chars max, and is a valid email format
if (!$email) {
    $errors['email'] = REQ;
} elseif ($emailError !== '') {
    $errors['email'] = $emailError;
} elseif (strlen($email) > 50) {
    $errors['email'] = MAX_50;
}

// PASSWORD: Check that password is not empty and is 6 to 20 chars
if (!$password) {
    $errors['password'] = REQ;
} elseif (strlen($password) < 6 || strlen($password) > 20) {
    $errors['password'] = PASSWORD_ERR;
}
?>