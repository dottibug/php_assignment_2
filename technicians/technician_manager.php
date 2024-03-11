<?php
// -----------------------------------------------------------------------------------------------
// Technician Manager
// The main interface for managing technicians. Users can add or delete technicians.
// -----------------------------------------------------------------------------------------------

// Database connection
require_once '../database.php';

// Get all technicians
$query = 'SELECT * FROM technicians';
$statement = $db->prepare($query);
$statement->execute();
$technicians = $statement->fetchAll();
$statement->closeCursor();
?>

<!doctype html>
<html lang="en">
<?php include_once '../view/head.html' ?>
<body>
<?php include_once '../view/header.php' ?>
<section>
    <h2>Technician List</h2>
    <table>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Password</th>
            <th></th>
        </tr>
        <?php foreach ($technicians as $technician) : ?>
            <tr>
                <td><?php echo $technician['firstName']; ?></td>
                <td><?php echo $technician['lastName']; ?></td>
                <td><?php echo $technician['email']; ?></td>
                <td><?php echo $technician['phone']; ?></td>
                <td><?php echo $technician['password']; ?></td>
                <td>
                    <form action="db_delete_technician.php" method="post">
                        <input type="hidden" name="techID"
                               value="<?php echo $technician['techID']; ?>">
                        <input type="submit" value="Delete">
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <br>
    <a href="add_technician.php">Add Technician</a>
</section>
<?php include_once '../view/footer.php' ?>
</body>
</html>