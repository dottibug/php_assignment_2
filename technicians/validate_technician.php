<?php
// -----------------------------------------------------------------------------------------------
// Validate Technician
// Validates the various technician input fields, ensuring they meet the database requirements.
// Stores any errors into an errors array that add_technician.php uses to display helpful
// error messages to the user.
// -----------------------------------------------------------------------------------------------

// Helper functions
require_once '../helpers/validEmail.php';

// Contains error messages for the related keys, if any. Used to show error messages on the
// add_technician form.
$errors = array('firstName' => null, 'lastName' => null, 'email' => null, 'phone' => null, 'password'
=> null);

const REQ = 'Required';
const MAX_50 = 'Must be 1 to 50 characters';
const MAX_20 = 'Must be 1 to 20 characters';
const PASSWORD_ERR = 'Must be 6 to 20 characters';

$emailError = validEmail($email);

// Validate phone format: 999-999-9999
function validPhoneFormat($phone)
{
    $pattern = "/^\d{3}-\d{3}-\d{4}$/";
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

// EMAIL: Check that email is not empty, has 50 chars max, and is a valid email format
if (!$email) {
    $errors['email'] = REQ;
} elseif ($emailError !== '') {
    $errors['email'] = $emailError;
} elseif (strlen($email) > 50) {
    $errors['email'] = MAX_50;
}

// PHONE: Check that phone is not empty and matches 999-999-9999 format
if (!$phone) {
    $errors['phone'] = REQ;
} elseif (!validPhoneFormat($phone)) {
    $errors['phone'] = 'Tel Format: 999-999-9999';
}

// PASSWORD: Check that password is not empty and is 6 to 20 chars
if (!$password) {
    $errors['password'] = REQ;
} elseif (strlen($password) < 6 || strlen($password) > 20) {
    $errors['password'] = PASSWORD_ERR;
}
?>