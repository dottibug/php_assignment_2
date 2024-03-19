<?php
session_start();

// Required files
require_once '../model/IncidentsDB.php';
require_once '../model/Form.php';
require_once '../model/Validate.php';

// Instantiate classes
$incidentsDB = new IncidentsDB();

// Action variables
const SHOW_LIST = 'show_list';
const SHOW_FORM = 'show_form';
const UPDATE = 'update';
const REFRESH = 'refresh';
const LOGOUT = 'logout';

// Only allow access to valid technicians
if (!$_SESSION['valid_tech']) {
    header("Location: ../technicians");
    exit();
}

// Get action type. Default action is show_list
$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL) {
        $action = SHOW_LIST;
    }
}

// Set up form fields for incident update form
$form = new Form();
$form->addField('dateClosed');
$form->addField('description');

// Set up validation for form
$validate = new Validate($form);

// Controller
switch ($action) {
    case (SHOW_LIST):
        $email = $_SESSION['tech_email'];
        $incidents = $incidentsDB->getAssignedIncidentsByEmail($email);
        $techHasIncidents = (bool)$incidents;
        include 'incident_list.php';
        break;
    case (SHOW_FORM):
        $incidentID = filter_input(INPUT_POST, 'incidentID');
        $incident = $incidentsDB->getIncidentByID($incidentID);
        $dateClosed = $incident->getDateClosed();
        $description = $incident->getDescription();
        $_SESSION['incidentID'] = $incident->getIncidentID();
        include 'update_incident_form.php';
        break;
    case (REFRESH):
        header("Location: .?action=show_list");
        break;
    case (UPDATE):
        // Get form data
        $dateClosed = filter_input(INPUT_POST, 'dateClosed');
        $description = filter_input(INPUT_POST, 'description');
        $incidentID = filter_input(INPUT_POST, 'incidentID');

        // Validate form data
        $validate->date('dateClosed', $dateClosed, false);
        $validate->text('description', $description, true, 1, 2000);

        // Check if form has errors
        if ($form->hasErrors()) {
            $incidentID = $_SESSION['incidentID'];
            $incident = $incidentsDB->getIncidentByID($incidentID);
            include 'update_incident_form.php';
        } // if no errors, update incident
        else {
            $incidentsDB->updateIncidentByID($incidentID, $description, $dateClosed);
            include 'update_incident_success.php';
        }
        break;
    case (LOGOUT):
        $_SESSION = array(); // Clear session data from memory
        session_destroy(); // Clean up session ID
        // Display technician login page
        header("Location: ../technicians");
        break;
}

?>


