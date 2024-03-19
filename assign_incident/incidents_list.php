<?php include '../view/header.php'; ?>
    <h2>Select Incident</h2>
    <table>
        <tr>
            <th>Customer</th>
            <th>Product</th>
            <th>Date Opened</th>
            <th>Title</th>
            <th>Description</th>
            <th></th>
        </tr>

        <!-- Incidents -->
        <?php foreach ($incidents as $incident) : ?>
            <tr>
                <td><?php echo $incident->getCustomerName(); ?></td>
                <td><?php echo $incident->getProductCode(); ?></td>
                <td><?php echo $incident->getFormattedDateOpened(); ?></td>
                <td><?php echo $incident->getTitle(); ?></td>
                <td><?php echo $incident->getDescription(); ?></td>
                <td>
                    <form action="index.php" method="post" id="select_incident">
                        <input type="hidden" name="action" value="show_tech_list">
                        <input type="hidden" name="incidentID" value="<?php echo
                        $incident->getIncidentID(); ?>">
                        <input type="submit" value="Select">
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

<?php include '../view/footer.php'; ?>