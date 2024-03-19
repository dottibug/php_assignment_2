<?php

// ------------------------------------------------------------------------------
// Database class
// ------------------------------------------------------------------------------
class Database
{
    private static $dsn = 'mysql:host=localhost;dbname=tech_support';
    private static $dbUsername = 'ts_user';
    private static $dbPassword = 'pa55word';

    private static $db;

    // ------------------------------------------------------------------------------
    // Get database connection
    // ------------------------------------------------------------------------------
    public static function getDB()
    {
        if (!isset(self::$db)) {
            try {
                self::$db = new PDO(self::$dsn, self::$dbUsername, self::$dbPassword);
            } catch (PDOException $e) {
                $error_message = $e->getMessage();
                include 'database_error.php';
                exit();
            }
        }
        return self::$db;
    }

    // ------------------------------------------------------------------------------
    // Display error page
    // ------------------------------------------------------------------------------
    public static function displayDBError($msg)
    {
        $error_message = $msg;
        include 'database_error.php';
        exit();
    }
}

?>
