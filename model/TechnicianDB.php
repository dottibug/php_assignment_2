<?php
// ------------------------------------------------------------------------------
// Interacts with the technicians table
// ------------------------------------------------------------------------------
require_once 'Database.php';

class TechnicianDB
{
    // ------------------------------------------------------------------------------
    // Get list of technicians (array of Technician objects)
    // ------------------------------------------------------------------------------
    public static function getTechnicians()
    {
        $db = Database::getDB(); // database connection

        $query = 'SELECT * FROM technicians';
        $statement = $db->query($query);
        $result = $statement->fetchAll();
        $statement->closeCursor();

        // Create array of technician objects
        $technicians = array();
        foreach ($result as $row) {
            $technician = new Technician(
                $row['firstName'],
                $row['lastName'],
                $row['email'],
                $row['phone'],
                $row['password']
            );
            $technician->setID($row['techID']);
            $technicians[] = $technician; // add new tech to technicians array
        }
        return $technicians;
    }

    // ------------------------------------------------------------------------------
    // Add technician to database
    // ------------------------------------------------------------------------------
    public static function addTechnician($technician)
    {
        $db = Database::getDB(); // database connection

        $firstName = $technician->getFirstName();
        $lastName = $technician->getLastName();
        $email = $technician->getEmail();
        $phone = $technician->getPhone();
        $password = $technician->getPassword();

        $query = "INSERT INTO technicians (firstName, lastName, email, phone, password) 
                    VALUES (:firstName, :lastName, :email, :phone, :password)";
        $statement = $db->prepare($query);
        $statement->bindValue(':firstName', $firstName);
        $statement->bindValue(':lastName', $lastName);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':phone', $phone);
        $statement->bindValue(':password', $password);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result;
    }

    // ------------------------------------------------------------------------------
    // Delete technician from database
    // ------------------------------------------------------------------------------
    public static function deleteTechnician($techID)
    {
        $db = Database::getDB();
        $query = "DELETE FROM technicians WHERE techID = :techID";
        $statement = $db->prepare($query);
        $statement->bindValue(':techID', $techID);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result;
    }
}

?>