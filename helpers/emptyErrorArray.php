<?php
// -----------------------------------------------------------------------------------------------
// Function: emptyErrorArray
// Checks if the given associative errors array is empty (i.e. the values for each key are null),
// which indicates there are no errors.
//
// Parameters: $array – an associative array for errors, with each key representing the error
// type and the values the associated error message for that key.
//
// Returns: boolean – True if all values in the array are null (no errors). False otherwise.
// -----------------------------------------------------------------------------------------------

function emptyErrorArray($array)
{
    foreach ($array as $key => $value) {
        if ($value !== null) {
            return false;
        }
    }
    return true;
}

?>