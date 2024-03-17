<?php include '../view/header.php'; ?>
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
            <td><?php echo $technician->getFirstName(); ?></td>
            <td><?php echo $technician->getLastName(); ?></td>
            <td><?php echo $technician->getEmail(); ?></td>
            <td><?php echo $technician->getPhone(); ?></td>
            <td><?php echo $technician->getPassword(); ?></td>
            <td>
                <form action="index.php" method="post" id="delete_technician_form">
                    <input type="hidden" name="action" value="delete_technician">
                    <input type="hidden" name="techID"
                           value="<?php echo $technician->getID(); ?>">
                    <input type="submit" value="Delete">
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<br>
<a href="index.php?action=show_add_form">Add Technician</a>
<?php include '../view/footer.php' ?>
