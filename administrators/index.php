<?php

// Start session management with a session cookie and secure connection
session_set_cookie_params(0, '/', '', true);
session_start();

// Required files
require_once '../model/Form.php';
require_once '../model/Validate.php';
require_once '../model/AdministratorsDB.php';

// Action variables
const SHOW_LOGIN = 'show_login';
const LOGIN = 'login';
const LOGOUT = 'logout';

// Instantiate classes
$adminDB = new AdministratorsDB();

// Create valid_admin cookie if it does not exist
if (!isset($_SESSION['valid_admin'])) {
    $_SESSION['valid_admin'] = false;
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
$form->addField('username');
$form->addField('password');

// Set up validation for form
$validate = new Validate($form);

// Controller
switch ($action) {
    case (SHOW_LOGIN):
        // Skip login if valid admin user has an existing session
        if ($_SESSION['valid_admin']) {
            include 'admin.php';
        } else {
            $username = '';
            $password = '';
            include 'admin_login.php';
        }
        break;
    case (LOGIN):
        // Get form data
        $username = filter_input(INPUT_POST, 'username');
        $password = filter_input(INPUT_POST, 'password');

        // Validate form data
        $validate->text('username', $username, true, 1, 40);
        $validate->text('password', $password, true, 1, 40);

        // Check if form has errors
        if ($form->hasErrors()) {
            include 'admin_login.php';
        } else {
            // Check if credentials match a valid admin
            $isValidAdmin = $adminDB->validAdmin($username, $password);
            // Show errors if invalid admin
            if (!$isValidAdmin) {
                $form->getField('username')->setError('Invalid username or password');
                $form->getField('password')->setError('Invalid username or password');
                include 'admin_login.php';
            } // If valid admin, regenerate session id, add valid_admin cookie, and show admin menu
            else {
                $_SESSION = array();
                session_regenerate_id();
                $_SESSION['valid_admin'] = true;
                include 'admin.php';
            }
        }
        break;
    case (LOGOUT):
        $_SESSION = array(); // Clear session data from memory
        session_destroy(); // Clean up session ID
        // Display main menu
        header("Location: ../index.php");
        break;
}
?>