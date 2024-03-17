<?php
require_once '../model/Form.php';
require_once '../model/Validate.php';
require_once '../model/CustomerDB.php';
require_once '../model/CountriesDB.php';
require_once '../model/Customer.php';

const SHOW_SEARCH = 'show_search';
const SEARCH = 'search';
const SHOW_ADD_FORM = 'show_add_form';
const SHOW_UPDATE_FORM = 'show_update_form';
const ADD_CUSTOMER = 'add_customer';
const UPDATE_CUSTOMER = 'update_customer';
const SHOW_SUCCESS = 'show_success';

// Get action type. Default action is show_search
$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL) {
        $action = SHOW_SEARCH;
    }
}

// Set up form fields for adding or updating a customer
$form = new Form();
$form->addField('firstName');
$form->addField('lastName');
$form->addField('address');
$form->addField('city');
$form->addField('state');
$form->addField('postalCode');
$form->addField('countryCode');
$form->addField('phone', 'Phone format: (999) 999-9999');
$form->addField('email');
$form->addField('password');

// Set up validation for form
$validate = new Validate($form);

// Controller
switch ($action) {
    case(SHOW_SEARCH):
        $lastName = '';
        $showSearchResults = false;
        include 'customer_search.php';
        break;
    case(SEARCH):
        // Get search form data
        $lastName = filter_input(INPUT_POST, 'lastName');

        // Validate search form data
        $validate->text('lastName', $lastName, true, 1, 50);

        // Check if form has errors
        if ($form->hasErrors()) {
            $showSearchResults = false;
            include 'customer_search.php';
        } // if no errors, get customer from database
        else {
            $customers = CustomerDB::getCustomerByLastName($lastName);

            if (!$customers) {
                $showSearchResults = false;
                $form->getField('lastName')->setError('No customer results. Try again.');
//                include 'customer_search.php';
            } else {
                $showSearchResults = true;
//                include 'customer_search.php';
            }
            include 'customer_search.php';
        }
        break;
    case(SHOW_ADD_FORM):
        $formType = 'add';
        $countries = CountriesDB::getCountries();
        $selectedCountry = CountriesDB::getSelectedCountry($formType);
        $firstName = '';
        $lastName = '';
        $address = '';
        $city = '';
        $state = '';
        $postalCode = '';
        $phone = '';
        $email = '';
        $password = '';
        include 'customer_form.php';
        break;
    case(SHOW_UPDATE_FORM):
        // Get form data
        $customerID = filter_input(INPUT_POST, 'customerID');

        // Get customer data
        $customer = CustomerDB::getCustomerByID($customerID);
        $firstName = $customer->getFirstName();
        $lastName = $customer->getLastName();
        $address = $customer->getAddress();
        $city = $customer->getCity();
        $state = $customer->getState();
        $postalCode = $customer->getPostalCode();
        $countryCode = $customer->getCountryCode();
        $phone = $customer->getPhone();
        $email = $customer->getEmail();
        $password = $customer->getPassword();

        // Get country data
        $countries = CountriesDB::getCountries();
        $selectedCountry = CountriesDB::getSelectedCountry('update', NULL, $countryCode);

        // Display update form
        $formType = 'update';
        $originalCountryCode = $countryCode;
        include 'customer_form.php';
        break;
    case(ADD_CUSTOMER):
        // Get form data
        $firstName = filter_input(INPUT_POST, 'firstName');
        $lastName = filter_input(INPUT_POST, 'lastName');
        $address = filter_input(INPUT_POST, 'address');
        $city = filter_input(INPUT_POST, 'city');
        $state = filter_input(INPUT_POST, 'state');
        $postalCode = filter_input(INPUT_POST, 'postalCode');
        $countryCode = filter_input(INPUT_POST, 'country');
        $phone = filter_input(INPUT_POST, 'phone');
        $email = filter_input(INPUT_POST, 'email');
        $password = filter_input(INPUT_POST, 'password');

        // Phone pattern in customer table
        $phonePattern = '/^\(\d{3}\) \d{3}-\d{4}$/';
        $phoneExample = '(999) 999-9999';

        // Validate form data
        $validate->text('firstName', $firstName, true, 1, 50);
        $validate->text('lastName', $lastName, true, 1, 50);
        $validate->text('address', $address, true, 1, 50);
        $validate->text('city', $city, true, 1, 50);
        $validate->text('state', $state, true, 1, 50);
        $validate->text('postalCode', $postalCode, true, 1, 20);
        $validate->phone('phone', $phone, $phonePattern, $phoneExample, true);
        $validate->email('email', $email, true);
        $validate->text('password', $password, true, 6, 20);

        // Check if form has errors
        if ($form->hasErrors()) {
            $formType = 'add';
            $countries = CountriesDB::getCountries();
            $selectedCountry = CountriesDB::getSelectedCountry($formType, $countryCode);
            include 'customer_form.php';
        } // If no errors, add customer
        else {
            $customer = new Customer($firstName, $lastName, $email, $phone, $password, $address,
                $city, $state, $postalCode, $countryCode);
            CustomerDB::addCustomer($customer);

            header("Location: .?action=show_success");
        }
        break;
    case(UPDATE_CUSTOMER):
        // Get form data
        $originalCountryCode = filter_input(INPUT_POST, 'originalCountryCode');
        $customerID = filter_input(INPUT_POST, 'customerID');
        $firstName = filter_input(INPUT_POST, 'firstName');
        $lastName = filter_input(INPUT_POST, 'lastName');
        $address = filter_input(INPUT_POST, 'address');
        $city = filter_input(INPUT_POST, 'city');
        $state = filter_input(INPUT_POST, 'state');
        $postalCode = filter_input(INPUT_POST, 'postalCode');
        $countryCode = filter_input(INPUT_POST, 'country');
        $phone = filter_input(INPUT_POST, 'phone');
        $email = filter_input(INPUT_POST, 'email');
        $password = filter_input(INPUT_POST, 'password');

        // Phone pattern in customer table
        $phonePattern = '/^\(\d{3}\) \d{3}-\d{4}$/';
        $phoneExample = '(999) 999-9999';

        // Validate form data
        $validate->text('firstName', $firstName, true, 1, 50);
        $validate->text('lastName', $lastName, true, 1, 50);
        $validate->text('address', $address, true, 1, 50);
        $validate->text('city', $city, true, 1, 50);
        $validate->text('state', $state, true, 1, 50);
        $validate->text('postalCode', $postalCode, true, 1, 20);
        $validate->phone('phone', $phone, $phonePattern, $phoneExample, true);
        $validate->email('email', $email, true);
        $validate->text('password', $password, true, 6, 20);

        // Check if form has errors
        if ($form->hasErrors()) {
            $formType = 'update';
            $countries = CountriesDB::getCountries();
            $selectedCountry = CountriesDB::getSelectedCountry($formType, $countryCode,
                $originalCountryCode);
            include 'customer_form.php';
        } // If no errors, update customer
        else {
            $customer = new Customer($firstName, $lastName, $email, $phone, $password, $address,
                $city, $state, $postalCode, $countryCode);
            $customer->setID($customerID);
            CustomerDB::updateCustomer($customer);

            header("Location: .?action=show_success");
        }
        break;
    case(SHOW_SUCCESS):
        include 'success.php';
        break;
}
?>