<?php
// -----------------------------------------------------------------------------------------------
// Validate Product
// Validates the various product input fields, ensuring they meet the database requirements.
// Stores any errors into an errors array that add_product.php uses to display helpful
// error messages to the user.
// -----------------------------------------------------------------------------------------------

// Contains error messages for the related keys, if any. Used to show error messages on the
// add_product form.
$errors = array('code' => null, 'name' => null, 'version' => null, 'release' => null);

const REQ = 'Required';

// Returns true if $version is positive and matches the decimal(18,1) data type.
function validVersion($version)
{
    // Max 17 digits before decimal, only 1 digit after decimal, and not negative (begins with digit, not -)
    $pattern = '/^\d{1,17}\.\d$/';
    return preg_match($pattern, $version);
}

// Check that product code is not empty and has max 10 chars
if (!$code) {
    $errors['code'] = REQ;
} elseif (strlen($code) > 10) {
    $errors['code'] = 'Must be 10 characters or less';
}

// Check that product name is not empty and has max 50 chars
if (!$name) {
    $errors['name'] = REQ;
} elseif (strlen($name) > 50) {
    $errors['name'] = 'Must be 50 characters or less';
}

// Check that product version is not empty, is positive, and matches decimal(18,1) data type
if (!$version) {
    $errors['version'] = REQ;
} elseif (!filter_var($version, FILTER_VALIDATE_FLOAT)) {
    $errors['version'] = 'Enter number to 1 decimal place (max 18 digits)';
} elseif (!validVersion($version)) {
    $errors['version'] = 'Enter number to 1 decimal place (max 18 digits)';
}

// Check that product release data is not empty and accepts any standard date format
if (!$release) {
    $errors['release'] = REQ;
} else {
    try {
        $date = new DateTime($release);
    } catch (Exception $e) {
        $errors['release'] = 'Invalid date format';
    }
}
?>