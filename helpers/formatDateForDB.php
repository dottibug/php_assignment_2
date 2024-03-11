<?php
// -----------------------------------------------------------------------------------------------
// Function: formatDateForDB
// Formats a PHP DateTime object into a string compatible with the MySQL DATETIME data type. Uses
// the 'Y-m-d H:i:s' format.
//
// Parameters: $dateObject – the DateTime object to be formatted
//
// Returns: A string in the format 'Y-m-d H:i:s'
// -----------------------------------------------------------------------------------------------
function formatDateForDB($dateObject)
{
    return $dateObject->format('Y-m-d H:i:s');
}

?>