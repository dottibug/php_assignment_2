<?php
require_once '../model/Form.php';
require_once '../model/Validate.php';
require_once '../model/ProductDB.php';
require_once '../model/Product.php';

const LIST_PRODUCTS = 'list_products';
const SHOW_ADD_FORM = 'show_add_form';
const ADD_PRODUCT = 'add_product';
const DELETE_PRODUCT = 'delete_product';

// Get action type. Default action is list_products
$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL) {
        $action = LIST_PRODUCTS;
    }
}

// Set up form fields for adding a product
$form = new Form();
$form->addField('productCode');
$form->addField('name');
$form->addField('version');
$form->addField('releaseDate', 'Use any valid date format');

// Set up validation for form
$validate = new Validate($form);

// Controller
switch ($action) {
    case(LIST_PRODUCTS):
        $products = ProductDB::getProducts(); // get all product_manager
        include 'product_list.php'; // display product list
        break;
    case(SHOW_ADD_FORM):
        // Set initial values of fields to empty string
        $productCode = '';
        $name = '';
        $version = '';
        $releaseDate = '';
        include 'add_product.php'; // display add product form
        break;
    case(ADD_PRODUCT):
        // Get form data
        $productCode = filter_input(INPUT_POST, 'productCode');
        $name = filter_input(INPUT_POST, 'name');
        $version = filter_input(INPUT_POST, 'version');
        $releaseDate = filter_input(INPUT_POST, 'releaseDate');

        // Version pattern: Max 17 digits before decimal, 1 digit after decimal, not negative
        $versionPattern = '/^\d{1,17}\.\d$/';
        $versionExample = '1.0';

        // Validate form data
        $validate->text('productCode', $productCode, true, 1, 10);
        $validate->text('name', $name, true, 1, 50);
        $validate->version('version', $version, $versionPattern, $versionExample, true);
        $validate->date('releaseDate', $releaseDate, true);

        // Check if form has errors
        if ($form->hasErrors()) {
            include 'add_product.php';
        } // if no errors, add product
        else {
            $product = new Product($productCode, $name, $version, $releaseDate);
            ProductDB::addProduct($product);

            // Display product list (rerun index.php to get updated product list)
            header("Location: .?action=list_products");
        }
        break;
    case(DELETE_PRODUCT):
        $productCode = filter_input(INPUT_POST, 'productCode');
        ProductDB::deleteProduct($productCode);

        // Display product list (rerun index.php to get updated product list)
        header("Location: .?action=list_products");
}

?>