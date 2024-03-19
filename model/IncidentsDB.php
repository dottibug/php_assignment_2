<?php
// ------------------------------------------------------------------------------
// Interacts with incidents table
// ------------------------------------------------------------------------------
require_once 'Database.php';
require_once 'Incident.php';
require_once 'TechIncident.php';
require_once 'CustomersDB.php';

class IncidentsDB
{
    private $incidents = array();

    // ------------------------------------------------------------------------------
    // Constructor
    // ------------------------------------------------------------------------------
    public function __construct()
    {
        $this->incidents = array();
    }

    // ------------------------------------------------------------------------------
    // Add incident to incidents table
    // ------------------------------------------------------------------------------
    public function createIncident($incident)
    {
        try {
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
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $statement->closeCursor();

            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            Database::displayDBError($error_message);
            return false;
        }
    }

    // ------------------------------------------------------------------------------
    // Get assigned open incidents by techID
    // ------------------------------------------------------------------------------
    public function getAssignedIncidentsByEmail($email)
    {
        try {
            $db = Database::getDB();

            $query = "SELECT 
                        customers.firstName AS customerFirstName, customers.lastName AS customerLastName,
                        technicians.firstName AS techFirstName, technicians.lastName AS techLastName,
                        products.name AS productName,
                        incidents.* 
                        FROM incidents
                            INNER JOIN customers ON incidents.customerID = customers.customerID
                            INNER JOIN technicians ON incidents.techID = technicians.techID
                            INNER JOIN products ON incidents.productCode = products.productCode
                        WHERE technicians.email = :email AND dateClosed IS NULL";

            $statement = $db->prepare($query);
            $statement->bindValue(':email', $email);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            $statement->closeCursor();

            // Create array of TechIncident objects
            foreach ($results as $row) {
                // Get customer's full name
                $customerName = $row['customerFirstName'] . ' ' . $row['customerLastName'];
                // Get technician's full name
                $techName = $row['techFirstName'] . ' ' . $row['techLastName'];

                $incident = new TechIncident(
                    $row['customerID'],
                    $row['productCode'],
                    $row['productName'],
                    $row['techID'],
                    $row['dateOpened'],
                    $row['dateClosed'],
                    $row['title'],
                    $row['description'],
                    $customerName,
                    $techName
                );
                $incident->setIncidentID($row['incidentID']);
                $this->incidents[] = $incident;
            }
            return $this->incidents;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            Database::displayDBError($error_message);
            return false;
        }
    }

    // ------------------------------------------------------------------------------
    // Get incident by ID
    // ------------------------------------------------------------------------------
    public function getIncidentByID($incidentID)
    {
        try {
            $db = Database::getDB();

            $query = "SELECT * FROM incidents WHERE incidentID = :incidentID";
            $statement = $db->prepare($query);
            $statement->bindValue(':incidentID', $incidentID);
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $statement->closeCursor();

            $incident = new Incident(
                $result['customerID'],
                $result['productCode'],
                $result['techID'],
                $result['dateOpened'],
                $result['dateClosed'],
                $result['title'],
                $result['description']
            );
            $incident->setIncidentID($result['incidentID']);
            return $incident;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            Database::displayDBError($error_message);
            return false;
        }
    }

    // ------------------------------------------------------------------------------
    // Update incident by ID. The current date is used for dateClosed if a date isn't provided.
    // ------------------------------------------------------------------------------
    public function updateIncidentByID($incidentID, $description, $dateClosed = 'now')
    {
        try {
            $db = Database::getDB();

            $query = "UPDATE incidents  
                        SET dateClosed = :dateClosed, description = :description 
                        WHERE incidentID = :incidentID";

            // Format dateClosed for MySQL datetime datatype
            $dateObject = new DateTime($dateClosed);
            $dateClosed_f = $dateObject->format('Y-m-d H:i:s');

            $statement = $db->prepare($query);
            $statement->bindValue(':dateClosed', $dateClosed_f);
            $statement->bindValue(':description', $description);
            $statement->bindValue(':incidentID', $incidentID);
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $statement->closeCursor();
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            Database::displayDBError($error_message);
            return false;
        }
    }

    // ------------------------------------------------------------------------------
    // Assign incident to technician
    // ------------------------------------------------------------------------------
    public function assignIncident($incidentID, $techID)
    {
        try {
            $db = Database::getDB();
            $query = "UPDATE incidents SET techID = :techID WHERE incidentID = :incidentID";
            $statement = $db->prepare($query);
            $statement->bindValue('techID', $techID);
            $statement->bindValue('incidentID', $incidentID);
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $statement->closeCursor();
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            Database::displayDBError($error_message);
            return false;
        }
    }

    // ------------------------------------------------------------------------------
    // Get unassigned incidents
    // ------------------------------------------------------------------------------
    public function getUnassignedIncidents()
    {
        try {
            $db = Database::getDB();

            $query = "SELECT 
                        customers.firstName AS customerFirstName, customers.lastName AS customerLastName,
                        products.name AS productName,
                        incidents.* 
                        FROM incidents
                            INNER JOIN customers ON incidents.customerID = customers.customerID
                            INNER JOIN products ON incidents.productCode = products.productCode
                        WHERE incidents.techID IS NULL";

            $statement = $db->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            $statement->closeCursor();

            // Create array of unassigned TechIncidents
            foreach ($results as $row) {
                // Get customer's full name
                $customerName = $row['customerFirstName'] . ' ' . $row['customerLastName'];
                // Get technician's full name
                $techName = null;

                $incident = new TechIncident(
                    $row['customerID'],
                    $row['productCode'],
                    $row['productName'],
                    $row['techID'],
                    $row['dateOpened'],
                    $row['dateClosed'],
                    $row['title'],
                    $row['description'],
                    $customerName,
                    $techName
                );
                $incident->setIncidentID($row['incidentID']);
                $this->incidents[] = $incident;
            }
            return $this->incidents;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            Database::displayDBError($error_message);
            return false;
        }
    }

    // ------------------------------------------------------------------------------
    // Get assigned incidents
    // ------------------------------------------------------------------------------
    public function getAssignedIncidents()
    {
        try {
            $db = Database::getDB();

            $query = "SELECT 
                        customers.firstName AS customerFirstName, customers.lastName AS customerLastName,
                        technicians.firstName AS techFirstName, technicians.lastName AS techLastName,
                        products.name AS productName,
                        incidents.* 
                        FROM incidents
                            INNER JOIN customers ON incidents.customerID = customers.customerID
                            INNER JOIN technicians ON incidents.techID = technicians.techID
                            INNER JOIN products ON incidents.productCode = products.productCode
                        WHERE incidents.techID IS NOT NULL";

            $statement = $db->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            $statement->closeCursor();

            // Create array of unassigned TechIncidents
            foreach ($results as $row) {
                // Get customer's full name
                $customerName = $row['customerFirstName'] . ' ' . $row['customerLastName'];
                // Get technician's full name
                $techName = $row['techFirstName'] . ' ' . $row['techLastName'];

                $incident = new TechIncident(
                    $row['customerID'],
                    $row['productCode'],
                    $row['productName'],
                    $row['techID'],
                    $row['dateOpened'],
                    $row['dateClosed'],
                    $row['title'],
                    $row['description'],
                    $customerName,
                    $techName
                );
                $incident->setIncidentID($row['incidentID']);
                $this->incidents[] = $incident;
            }
            return $this->incidents;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            Database::displayDBError($error_message);
            return false;
        }
    }
}

?>