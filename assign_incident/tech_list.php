<?php include '../view/header.php'; ?>
<h2>Select Technician</h2>
<table>
    <tr>
        <th>Name</th>
        <th>Open Incidents</th>
        <th></th>
    </tr>

    <!-- Technicians -->
    <?php foreach ($technicians as $technician) : ?>
        <tr>
            <td><?php echo $technician->getFullName(); ?></td>
            <td class="center"><?php echo $technician->getNumberOfOpenIncidents(); ?></td>
            <td>
                <form action="index.php" method="post" id="select_tech">
                    <input type="hidden" name="action" value="show_summary">
                    <input type="hidden" name="techID" value="<?php echo $technician->getID(); ?>">
                    <input type="submit" value="Select">
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    
</table>
<?php include '../view/footer.php'; ?>
