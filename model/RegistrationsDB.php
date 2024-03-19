<?php
// ------------------------------------------------------------------------------
// Interacts with registrations table
// ------------------------------------------------------------------------------

require_once 'Database.php';
require_once 'Registration.php';

class RegistrationsDB
{
    // ------------------------------------------------------------------------------
    // Register product
    // ------------------------------------------------------------------------------
    public function registerProduct($productCode, $customerID)
    {
        try {
            $db = Database::getDB();

            // Check if customer has already registered the product.
            // If so, return true instead of inserting the registration.
            $query = "SELECT * FROM registrations 
                        WHERE customerID = :customerID AND productCode = :productCode";

            $statement = $db->prepare($query);
            $statement->bindValue(':customerID', $customerID);
            $statement->bindValue(':productCode', $productCode);
            $statement->execute();
            $registration = $statement->fetch(PDO::FETCH_ASSOC);
            $statement->closeCursor();

            if ($registration) {
                return $registration;
            } // Add new registration to registrations table
            else {
                // Format registration date for MySQL datetime datatype
                $dateObject = new DateTime('now');
                $registrationDate = $dateObject->format('Y-m-d H:i:s');

                $query = "INSERT INTO registrations (customerID, productCode, registrationDate) 
                        VALUES (:customerID, :productCode, :registrationDate)";

                $statement = $db->prepare($query);
                $statement->bindValue(':customerID', $customerID);
                $statement->bindValue(':productCode', $productCode);
                $statement->bindValue(':registrationDate', $registrationDate);
                $statement->execute();
                $registration = $statement->fetch(PDO::FETCH_ASSOC);
                $statement->closeCursor();
            }
            return $registration;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            Database::displayDBError($error_message);
            return false;
        }
    }

    // ------------------------------------------------------------------------------
    // Register product
    // ------------------------------------------------------------------------------
    public function getRegistrationsByCustomerID($customerID)
    {
        try {
            $db = Database::getDB();

            $query = "SELECT * FROM registrations 
                    INNER JOIN products ON registrations.productCode = products.productCode 
                    WHERE customerID = :customerID";

            $statement = $db->prepare($query);
            $statement->bindValue(':customerID', $customerID);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            $statement->closeCursor();

            // Create array of Registration objects
            $registrations = array();
            foreach ($result as $row) {
                $registration = new Registration(
                    $row['customerID'],
                    $row['productCode'],
                    $row['name'],
                    $row['registrationDate']
                );
                $registrations[] = $registration;
            }
            return $registrations;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            Database::displayDBError($error_message);
            return false;
        }
    }
}

?>