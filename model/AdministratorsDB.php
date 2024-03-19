<?php
// ------------------------------------------------------------------------------
// Interacts with administrators table
// ------------------------------------------------------------------------------
require_once 'Database.php';

class AdministratorsDB
{
    // ------------------------------------------------------------------------------
    // Checks if arguments match a valid admin from the administrators table
    // ------------------------------------------------------------------------------
    public function validAdmin($username, $password)
    {
        try {
            $db = Database::getDB();
            $query = "SELECT password FROM administrators WHERE username = :username";
            $statement = $db->prepare($query);
            $statement->bindValue(':username', $username);
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $statement->closeCursor();
            // Return true if there is a valid match, false otherwise
            return $result !== false && $result['password'] === $password;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            Database::displayDBError($error_message);
            return false;
        }
    }
}

?>

