<?php
// ------------------------------------------------------------------------------
// Interacts with incidents table
// ------------------------------------------------------------------------------
require_once 'Database.php';

class IncidentsDB
{
    // ------------------------------------------------------------------------------
    // Add incident to incidents table
    // ------------------------------------------------------------------------------
    public static function createIncident($incident)
    {
        $db = Database::getDB();

        $customerID = $incident->getCustomerID();
        $productCode = $incident->getProductCode();
        $techID = $incident->getTechID();
        $dateOpened = $incident->getDateOpened();
        $dateClosed = $incident->getDateClosed();
        $title = $incident->getTitle();
        $description = $incident->getDescription();

        $query = "INSERT INTO incidents (customerID, productCode, techID, dateOpened, 
                                         dateClosed, title, description) 
                        VALUES (:customerID, :productCode, :techID, :dateOpened, 
                                :dateClosed, :title, :description)";

        $statement = $db->prepare($query);
        $statement->bindValue(':customerID', $customerID);
        $statement->bindValue(':productCode', $productCode);
        $statement->bindValue(':techID', $techID);
        $statement->bindValue(':dateOpened', $dateOpened);
        $statement->bindValue(':dateClosed', $dateClosed);
        $statement->bindValue(':title', $title);
        $statement->bindValue(':description', $description);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();

        return $result;
    }
}

?>