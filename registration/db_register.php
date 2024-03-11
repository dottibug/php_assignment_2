<?php
// -----------------------------------------------------------------------------------------------
// Database: Register Product
// Adds product registration to the database. If the product was already registered by the
// customer previously, a success message shows. Otherwise, the product registration is added to
// the database and then a success message shown.
// -----------------------------------------------------------------------------------------------

// Database connection
require_once '../database.php';

// Date format helper
require '../helpers/formatDateForDB.php';

// Post data
$customerID = filter_input(INPUT_POST, 'customerID');
$productCode = filter_input(INPUT_POST, 'productCode');

// Check for duplicate in registrations table. If already registered, show success message
$query = 'SELECT * FROM registrations WHERE customerID = :customerID AND productCode = :productCode';
$statement1 = $db->prepare($query);
$statement1->bindValue(':customerID', $customerID);
$statement1->bindValue(':productCode', $productCode);
$statement1->execute();
$customerRegs = $statement1->fetchAll(PDO::FETCH_ASSOC);
$statement1->closeCursor();

// Add to registrations table if not already registered
if (!$customerRegs) {
    $dateObject = new DateTime('now');
    $registrationDate = formatDateForDB($dateObject);

    $query = 'INSERT INTO registrations VALUES (:customerID, :productCode, :registrationDate)';
    $statement2 = $db->prepare($query);
    $statement2->bindValue(':customerID', $customerID);
    $statement2->bindValue(':productCode', $productCode);
    $statement2->bindValue(':registrationDate', $registrationDate);
    $statement2->execute();
    $statement2->closeCursor();
}
?>

<!doctype html>
<html lang="en">
<?php include_once '../view/head.html' ?>
<body>
<?php include_once '../view/header.php' ?>

<section>
    <h2>Register Product</h2>
    <p>Product (<?php echo $productCode; ?>) was registered successfully.</p>
</section>

<?php include_once '../view/footer.php' ?>
</body>
</html>


