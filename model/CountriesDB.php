<?php
// ------------------------------------------------------------------------------
// Interacts with countries table
// ------------------------------------------------------------------------------
require_once 'Database.php';
require_once 'Country.php';

class CountriesDB
{
    // ------------------------------------------------------------------------------
    // Get all countries
    // ------------------------------------------------------------------------------
    public static function getCountries()
    {
        $db = Database::getDB();

        $query = "SELECT * FROM countries";
        $statement = $db->query($query);
        $result = $statement->fetchAll();
        $statement->closeCursor();

        // Create array of Country objects
        $countries = array();
        foreach ($result as $row) {
            $country = new Country(
                $row['countryCode'],
                $row['countryName']
            );
            $countries[] = $country;
        }
        return $countries;
    }

    // ------------------------------------------------------------------------------
    // Get country name by country code
    // ------------------------------------------------------------------------------
    public static function getCountryNameByCode($code)
    {
        $db = Database::getDB();
        $query = "SELECT * FROM countries WHERE countryCode = :code";
        $statement = $db->prepare($query);
        $statement->bindValue(':code', $code);
        $statement->execute();
        $country = $statement->fetch();
        $statement->closeCursor();
        return $country['countryName'];
    }

    // ------------------------------------------------------------------------------
    // Get country that should be the selected option on the customer form (result depends on the
    // type of customer form ("add" or "update")
    // ------------------------------------------------------------------------------
    public static function getSelectedCountry($formType, $formCountryCode = NULL,
                                              $originalCountryCode = NULL)
    {
        // Get selected country when adding customers
        if ($formType === 'add') {
            $defaultCountryName = 'Canada';
            $defaultCountryCode = 'CA';

            // Update selected country if it differs from the default
            if ($formCountryCode !== NULL && $formCountryCode !== $defaultCountryCode) {
                // Get country name from the country code
                $db = Database::getDB();
                $query = "SELECT * FROM countries WHERE countryCode = :formCountryCode";
                $statement = $db->prepare($query);
                $statement->bindValue(':formCountryCode', $formCountryCode);
                $statement->execute();
                $country = $statement->fetch();
                $statement->closeCursor();
                $selectedCountry = $country['countryName'];
            } else {
                $selectedCountry = $defaultCountryName;
            }
        } // Get selected country for updating customers
        else {
            $defaultCountryCode = $originalCountryCode;
            $defaultCountryName = self::getCountryNameByCode($defaultCountryCode);

            // Update selected country if it changes from default
            if ($formCountryCode !== NULL && $formCountryCode !== $defaultCountryCode) {
                // Get new country name from the country code
                $selectedCountry = self::getCountryNameByCode($formCountryCode);
            } else {
                $selectedCountry = $defaultCountryName;
            }
        }
        return $selectedCountry;
    }
}

?>