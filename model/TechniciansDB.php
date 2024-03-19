<?php
// ------------------------------------------------------------------------------
// Interacts with the technicians table
// ------------------------------------------------------------------------------
require_once 'Database.php';
require_once 'Technician.php';

class TechniciansDB
{
    // ------------------------------------------------------------------------------
    // Get list of technicians (array of Technician objects)
    // ------------------------------------------------------------------------------
    public function getTechnicians()
    {
        try {
            $db = Database::getDB();

            // Fetch technicians
            $query = 'SELECT t.*,
                        (SELECT COUNT(*) FROM incidents i WHERE i.techID = t.techID) AS num 
                        FROM technicians t ORDER BY num';
            $statement = $db->prepare($query);
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            $statement->closeCursor();

            // Create array of technician objects
            $technicians = array();
            foreach ($results as $row) {
                $technician = new Technician(
                    $row['firstName'],
                    $row['lastName'],
                    $row['email'],
                    $row['phone'],
                    $row['password'],
                    $row['num']
                );
                $technician->setID($row['techID']);
                $technicians[] = $technician; // add new tech to technicians array
            }
            return $technicians;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            Database::displayDBError($error_message);
            return false;
        }
    }

    // ------------------------------------------------------------------------------
    // Add technician to database
    // ------------------------------------------------------------------------------
    public function addTechnician($technician)
    {
        try {
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
    // Delete technician from database
    // ------------------------------------------------------------------------------
    public function deleteTechnician($techID)
    {
        try {
            $db = Database::getDB();
            $query = "DELETE FROM technicians WHERE techID = :techID";
            $statement = $db->prepare($query);
            $statement->bindValue(':techID', $techID);
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
    // Checks if arguments match a valid tech from the technicians table
    // ------------------------------------------------------------------------------
    public function validTech($email, $password)
    {
        try {
            $db = Database::getDB();

            $query = "SELECT password FROM technicians WHERE email = :email";
            $statement = $db->prepare($query);
            $statement->bindValue(':email', $email);
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $statement->closeCursor();

            return $result !== false && $result['password'] === $password;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            Database::displayDBError($error_message);
            return false;
        }
    }

    // ------------------------------------------------------------------------------
    // Get technician by ID
    // ------------------------------------------------------------------------------
    public function getTechByID($techID)
    {
        try {
            $db = Database::getDB();

            $query = "SELECT t.*, 
                        (SELECT COUNT(*) FROM incidents i WHERE i.techID = t.techID) AS num
                        FROM technicians t WHERE techID = :techID";
            $statement = $db->prepare($query);
            $statement->bindValue(':techID', $techID);
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $statement->closeCursor();

            // Create new Technician
            $technician = new Technician(
                $result['firstName'],
                $result['lastName'],
                $result['email'],
                $result['phone'],
                $result['password'],
                $result['num']
            );
            $technician->setID($result['techID']);
            return $technician;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            Database::displayDBError($error_message);
            return false;
        }
    }
}

?>