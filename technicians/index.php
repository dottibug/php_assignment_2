<?php
// Start session management with a session cookie and secure connection
session_set_cookie_params(0, '/', '', true);
session_start();

// Required files
require_once '../model/Form.php';
require_once '../model/Validate.php';
require_once '../model/TechniciansDB.php';

// Instantiate classes
$techniciansDB = new TechniciansDB();

// Action variables
const SHOW_LOGIN = 'show_login';
const LOGIN = 'login';

// Create valid_tech cookie if it does not exist
if (!isset($_SESSION['valid_tech'])) {
    $_SESSION['valid_tech'] = false;
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

// Controller {
switch ($action) {
    case (SHOW_LOGIN):
        // Skip login if valid tech user has an existing session
        if ($_SESSION['valid_tech']) {
            header("Location: ../update_incident");
        } else {
            $email = '';
            $password = '';
            include 'tech_login.php';
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
            include 'tech_login.php';
        } else {
            // Check if credentials match a technician
            $isValidTech = $techniciansDB->validTech($email, $password);
            // Show errors if invalid tech
            if (!$isValidTech) {
                $form->getField('email')->setError('Invalid email or password');
                $form->getField('password')->setError('Invalid email or password');
                include 'tech_login.php';
            } // If valid tech, regenerate session id, add valid_tech cookie, and
            // display select incident page
            else {
                $_SESSION = array();
                session_regenerate_id();
                $_SESSION['valid_tech'] = true;
                $_SESSION['tech_email'] = $email;
                header("Location: ../update_incident");
            }
        }
        break;
}
?>
