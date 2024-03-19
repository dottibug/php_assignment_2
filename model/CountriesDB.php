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
    public function getCountries()
    {
        try {
            $db = Database::getDB();
            $query = "SELECT * FROM countries";
            $statement = $db->query($query);
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
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
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            Database::displayDBError($error_message);
            return false;
        }
    }

    // ------------------------------------------------------------------------------
    // Get country name by country code
    // ------------------------------------------------------------------------------
    public function getCountryNameByCode($code)
    {
        try {
            $db = Database::getDB();
            $query = "SELECT * FROM countries WHERE countryCode = :code";
            $statement = $db->prepare($query);
            $statement->bindValue(':code', $code);
            $statement->execute();
            $country = $statement->fetch(PDO::FETCH_ASSOC);
            $statement->closeCursor();
            return $country['countryName'];
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            Database::displayDBError($error_message);
            return false;
        }
    }

    // ------------------------------------------------------------------------------
    // Get country that should be the selected option on the customer form (result depends on the
    // type of customer form ("add" or "update")
    // ------------------------------------------------------------------------------
    public function getSelectedCountry($formType, $formCountryCode = NULL,
                                       $originalCountryCode = NULL)
    {
        // Get selected country when ADDING customers
        if ($formType === 'add') {
            $defaultCountryName = 'Canada';
            $defaultCountryCode = 'CA';

            // Update selected country if it differs from the default
            if ($formCountryCode !== NULL && $formCountryCode !== $defaultCountryCode) {
                try {
                    // Get country name from the country code
                    $db = Database::getDB();
                    $query = "SELECT * FROM countries WHERE countryCode = :formCountryCode";
                    $statement = $db->prepare($query);
                    $statement->bindValue(':formCountryCode', $formCountryCode);
                    $statement->execute();
                    $country = $statement->fetch(PDO::FETCH_ASSOC);
                    $statement->closeCursor();
                    $selectedCountry = $country['countryName'];
                } catch (PDOException $e) {
                    $error_message = $e->getMessage();
                    Database::displayDBError($error_message);
                    return false;
                }
                // Selected country is the default country if there are no changes
            } else {
                $selectedCountry = $defaultCountryName;
            }
        } // Get selected country for UPDATING customers
        else {
            $defaultCountryCode = $originalCountryCode;
            $defaultCountryName = $this->getCountryNameByCode($defaultCountryCode);

            // Update selected country if it changes from default
            if ($formCountryCode !== NULL && $formCountryCode !== $defaultCountryCode) {
                // Get new country name from the country code
                $selectedCountry = $this->getCountryNameByCode($formCountryCode);
            } else {
                $selectedCountry = $defaultCountryName;
            }
        }
        return $selectedCountry;
    }
}

?>