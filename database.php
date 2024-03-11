<?php

$dsn = 'mysql:host=localhost;dbname=tech_support';
$dbUsername = 'ts_user';
$dbPassword = 'pa55word';

try {
    $db = new PDO($dsn, $dbUsername, $dbPassword);
} catch (PDOException $e) {
    $error_message = $e->getMessage();
    include_once 'database_error.php';
    exit();
}

?>