<?php include '../view/header.php'; ?>
<h2>Assigned Incidents</h2>
<a href=".?action=show_unassigned_list">View Unassigned Incidents</a>

<table>
    <tr>
        <th>Customer</th>
        <th>Product</th>
        <th>Technician</th>
        <th>Incident</th>
    </tr>

    <!-- Incidents -->
    <?php foreach ($incidents as $incident) : ?>
        <tr>
            <td><?php echo $incident->getCustomerName(); ?></td>
            <td><?php echo $incident->getProductName(); ?></td>
            <td><?php echo $incident->getTechName(); ?></td>
            <td class="tableDetails">
                <!-- ID -->
                <div class="tableIncidentDetails">
                    <label for="incidentID">ID:</label>
                    <p><?php echo $incident->getIncidentID(); ?></p>
                </div>

                <!-- Date Opened -->
                <div class="tableIncidentDetails">
                    <label for="dateOpened">Opened:</label>
                    <p><?php echo $incident->getFormattedDateOpened(); ?></p>
                </div>

                <!-- Date Closed -->
                <div class="tableIncidentDetails">
                    <label for="dateClosed">Closed:</label>
                    <p><?php echo($incident->getFormattedDateClosed() ?? 'OPEN'); ?></p>
                </div>

                <!-- Title -->
                <div class="tableIncidentDetails">
                    <label for="title">Title:</label>
                    <p><?php echo $incident->getTitle(); ?></p>
                </div>

                <!-- Description -->
                <div class="tableIncidentDetails">
                    <label for="description">Description:</label>
                    <p><?php echo nl2br($incident->getDescription()); ?></p>
                </div>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<?php include '../view/footer.php'; ?>
