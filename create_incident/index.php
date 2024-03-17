<?php
require_once '../model/Form.php';
require_once '../model/Validate.php';
require_once '../model/CustomerDB.php';
require_once '../model/RegistrationsDB.php';
require_once '../model/Incident.php';
require_once '../model/IncidentsDB.php';

const SHOW_SEARCH = 'show_customer_search';
const SEARCH = 'search';
const CREATE_INCIDENT = 'create_incident';

// Get action type. Default action is show_customer_search
$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL) {
        $action = SHOW_SEARCH;
    }
}

// Set up form fields for customer search and incident forms
$form = new Form();
$form->addField('email');
$form->addField('productCode');
$form->addField('title');
$form->addField('description');

// Set up validation for form
$validate = new Validate($form);

// Controller
switch ($action) {
    case(SHOW_SEARCH):
    {
        $email = '';
        include 'customer_search.php';
        break;
    }
    case(SEARCH):
        // Get search form data
        $email = filter_input(INPUT_POST, 'email');

        // Validate email
        $validate->email('email', $email, true);

        // Check if form has errors
        if ($form->hasErrors()) {
            include 'customer_search.php';
        } else {
            // Get customer by email
            $customer = CustomerDB::getCustomerByEmail($email);
            $customerID = $customer->getID();

            if (!$customer) {
                $form->getField('email')->setError('No customer results. Try again.');
                include 'customer_search.php';
            } else {
                // Get customer's registered products
                $registrations = RegistrationsDB::getRegistrationsByCustomerID($customerID);
                $title = '';
                $description = '';
                include 'create_incident_form.php';
            }
        }
        break;
    case (CREATE_INCIDENT):
        // Get form data
        $email = filter_input(INPUT_POST, 'email');
        $productCode = filter_input(INPUT_POST, 'productCode');
        $title = filter_input(INPUT_POST, 'title');
        $description = filter_input(INPUT_POST, 'description');

        // Refetch customer data
        /// NOTE::: the refetching below shouldn't be needed once using sessions
        // Get customer by email
        $customer = CustomerDB::getCustomerByEmail($email);
        $customerID = $customer->getID();

        // Validate form data
        $validate->text('title', $title, true, 1, 50);
        $validate->text('description', $description, true, 1, 2000);

        // Check if form has errors
        if ($form->hasErrors()) {
            $registrations = RegistrationsDB::getRegistrationsByCustomerID($customerID);
            include 'create_incident_form.php';
        } // If no errors, add incident
        else {
            $customerID = $customer->getID();
            $techID = null;
            $dateClosed = null;

            // Get current date and format for MySQL datetime datatype for dateOpened
            $dateObject = new DateTime('now');
            $dateOpened = $dateObject->format('Y-m-d H:i:s');

            // Create Incident object
            $incident = new Incident($customerID, $productCode, $techID, $dateOpened,
                $dateClosed, $title, $description);

            // Add incident to database
            IncidentsDB::createIncident($incident);

            // Show success message
            include 'create_incident_success.php';
        }
}


?>