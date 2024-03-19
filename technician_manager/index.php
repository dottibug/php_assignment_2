<?php
session_start();

// Action variables
require_once '../model/Form.php';
require_once '../model/Validate.php';
require_once '../model/TechniciansDB.php';
require_once '../model/Technician.php';

// Instantiate classes
$techniciansDB = new TechniciansDB();

// Actions for technician manager
const LIST_TECHNICIANS = 'list_technicians';
const SHOW_ADD_FORM = 'show_add_form';
const ADD_TECHNICIAN = 'add_technician';
const DELETE_TECHNICIAN = 'delete_technician';

// Only allow access to valid admin
if (!$_SESSION['valid_admin']) {
    header("Location: ../administrators");
    exit();
}

// Get action type. Default action is list_technicians
$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL) {
        $action = LIST_TECHNICIANS;
    }
}

// Set up form fields for adding a technician
$form = new Form();
$form->addField('firstName');
$form->addField('lastName');
$form->addField('email');
$form->addField('phone', 'Phone format: 999-999-9999');
$form->addField('password');

// Set up validation for form
$validate = new Validate($form);

// Controller
switch ($action) {
    case(LIST_TECHNICIANS):
        $technicians = $techniciansDB->getTechnicians();
        include 'technician_list.php';
        break;
    case(SHOW_ADD_FORM):
        // Set initial values of fields to empty string
        $firstName = '';
        $lastName = '';
        $email = '';
        $phone = '';
        $password = '';
        include 'add_technician.php';
        break;
    case(ADD_TECHNICIAN):
        // Get form data
        $firstName = filter_input(INPUT_POST, 'firstName');
        $lastName = filter_input(INPUT_POST, 'lastName');
        $email = filter_input(INPUT_POST, 'email');
        $phone = filter_input(INPUT_POST, 'phone');
        $password = filter_input(INPUT_POST, 'password');

        // Phone pattern in technician table
        $phonePattern = '/^\d{3}-\d{3}-\d{4}$/';
        $phoneExample = '999-999-9999';

        // Validate the form data
        $validate->text('firstName', $firstName, true, 1, 50);
        $validate->text('lastName', $lastName, true, 1, 50);
        $validate->email('email', $email, true);
        $validate->phone('phone', $phone, $phonePattern, $phoneExample, true);
        $validate->text('password', $password, true, 6, 20);

        // Check if form has errors
        if ($form->hasErrors()) {
            include 'add_technician.php';
        } // If no errors, add technician
        else {
            $technician = new Technician($firstName, $lastName, $email, $phone, $password);
            $techniciansDB->addTechnician($technician);

            // Display technician list (rerun index.php to get updated technician list)
            header("Location: .?action=list_technicians");
        }
        break;
    case (DELETE_TECHNICIAN):
        $techID = filter_input(INPUT_POST, 'techID');
        $techniciansDB->deleteTechnician($techID);

        // Display technician list (rerun index.php to get updated technician list)
        header("Location: .?action=list_technicians");
}


?>