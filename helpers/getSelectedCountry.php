<?php
// -------------------------------------------------------------------------------------------
// Function: getSelectedCountry
// Determines the default and selected country to be displayed in the country dropdown menu
// of add_update_customer.php. Defaults to 'Canada' if the action is add; otherwise defaults to
// the countryName value from the database. New country selections persist after form submission,
// so the dropdown displays the correct country selection even if the form had errors for other
// input fields.
//
// Parameters:
//  - $action: the action for the form ('add' or 'update')
//  - $customer: array containing customer information from the database
//  - $countries: array of countries from the database
//
// Returns: String of the country that should be set as selected in the dropdown menu
// -------------------------------------------------------------------------------------------

function getSelectedCountry($action, $customer, $countries)
{
    // Default to 'Canada' if adding a customer or database value if updating a customer
    $defaultCountry = $action === 'add' ? 'Canada' : $customer['countryName'];

    // Get new country code
    $newCountryCode = filter_input(INPUT_POST, 'countryCode');
    $newCountryName = '';

    // Match new country code to the country name
    foreach ($countries as $country) {
        // Finds new country name based on the newly selected country code
        if ($country['countryCode'] === $newCountryCode) {
            $newCountryName = $country['countryName'];
            break;
        }
    }
    // Return which country should be the selected country in the country dropdown
    return $newCountryName !== '' ? $newCountryName : $defaultCountry;
}

?>