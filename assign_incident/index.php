<?php

session_start();

// Required Files
require_once '../model/IncidentsDB.php';
require_once '../model/TechniciansDB.php';
require_once '../model/CustomersDB.php';

// Instantiate classes
$incidentsDB = new IncidentsDB();
$techniciansDB = new TechniciansDB();
$customersDB = new CustomersDB();

// Action variables
const SHOW_INCIDENT_LIST = 'show_incident_list';
const SHOW_TECH_LIST = 'show_tech_list';
const SHOW_SUMMARY = 'show_summary';
const ASSIGN = 'assign';

// Only allow access to valid admin users
if (!$_SESSION['valid_admin']) {
    header("Location: ../administrators");
    exit();
}

// Get action type. Default is show_incident_list
$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL) {
        $action = SHOW_INCIDENT_LIST;
    }
}

// Controller
switch ($action) {
    case (SHOW_INCIDENT_LIST):
        $incidents = $incidentsDB->getUnassignedIncidents();
        include 'incidents_list.php';
        break;
    case (SHOW_TECH_LIST):
        $incidentID = filter_input(INPUT_POST, 'incidentID');
        $_SESSION['incidentID'] = $incidentID;
        $technicians = $techniciansDB->getTechnicians();
        include 'tech_list.php';
        break;
    case (SHOW_SUMMARY):
        $techID = filter_input(INPUT_POST, 'techID');
        $_SESSION['techID'] = $techID;
        $incident = $incidentsDB->getIncidentByID($_SESSION['incidentID']);
        $customerID = $incident->getCustomerID();
        $customer = $customersDB->getCustomerByID($customerID);
        $technician = $techniciansDB->getTechByID($techID);
        include 'summary.php';
        break;
    case (ASSIGN):
        $incidentID = $_SESSION['incidentID'];
        $techID = $_SESSION['techID'];
        $incidentsDB->assignIncident($incidentID, $techID);
        include 'assign_success.php';
        break;
}

?>
