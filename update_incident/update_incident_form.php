<?php include '../view/header.php'; ?>
<h2>Update Incident</h2>
<form action="index.php" method="post" id="update_incident_form">
    <input type="hidden" name="action" value="update">

    <!-- Incident ID -->
    <div class="formLabelInput">
        <label for="incidentID">Incident ID:</label>
        <p><?php echo $incident->getIncidentID(); ?></p>
    </div>

    <!-- Product Code -->
    <div class="formLabelInput">
        <label for="productCode">Product Code:</label>
        <p><?php echo $incident->getProductCode(); ?></p>
    </div>

    <!-- Date Opened -->
    <div class="formLabelInput">
        <label for="dateOpened">Date Opened:</label>
        <p><?php echo $incident->getFormattedDateOpened(); ?></p>
    </div>

    <!-- Date Closed -->
    <div class="formLabelInput">
        <label for="dateClosed">Date Closed:</label>
        <input type="text" name="dateClosed" id="dateClosed" value="<?php echo $dateClosed; ?>">
        <!-- Conditionally render error -->
        <?php if ($form->getField('dateClosed')->hasError()): ?>
            <?php echo $form->getField('dateClosed')->getErrorHTML(); ?>
        <?php endif; ?>
    </div>

    <!-- Title -->
    <div class="formLabelInput">
        <label for="title">Title:</label>
        <p><?php echo $incident->getTitle(); ?></p>
    </div>

    <!-- Description -->
    <div class="formLabelInput">
        <label for="description">Description:</label>
        <textarea name="description" id="description" rows="5"><?php echo $description; ?>
        </textarea>
        <!-- Conditionally render error -->
        <?php if ($form->getField('description')->hasError()): ?>
            <?php echo $form->getField('description')->getErrorHTML(); ?>
        <?php endif; ?>
    </div>

    <!-- Submit -->
    <input type="hidden" name="incidentID" value="<?php echo $incident->getIncidentID(); ?>">
    <input type="submit" value="Update Incident" class="submitButtonIndent">
</form>

<?php include 'login_info.php'; ?>
<?php include '../view/footer.php'; ?>
