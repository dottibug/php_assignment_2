<?php
session_start();

// Required Files
require_once '../model/IncidentsDB.php';

// Instantiate classes
$incidentsDB = new IncidentsDB();

// Action variables
const SHOW_UNASSIGNED_LIST = 'show_unassigned_list';
const SHOW_ASSIGNED_LIST = 'show_assigned_list';

// Only allow access to valid admin users
if (!$_SESSION['valid_admin']) {
    header("Location: ../administrators");
    exit();
}

// Get action type. Default is show_unassigned_list
$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL) {
        $action = SHOW_UNASSIGNED_LIST;
    }
}

// Controller
switch ($action) {
    case (SHOW_UNASSIGNED_LIST):
        $incidents = $incidentsDB->getUnassignedIncidents();
        include 'unassigned_list.php';
        break;
    case (SHOW_ASSIGNED_LIST):
        $incidents = $incidentsDB->getAssignedIncidents();
        include 'assigned_list.php';
        break;
}

?>
