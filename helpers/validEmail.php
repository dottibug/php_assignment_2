<?php
// -----------------------------------------------------------------------------------------------
// function: ValidEmail
// Check email for one @ symbol, a username part, and a domain part. Also uses PHP's
// FILTER_VALIDATE_EMAIL to perform general email validation.
//
// Parameters: $email – The email to check
// Returns: A string with a related error message if the email is invalid; null otherwise.
// -----------------------------------------------------------------------------------------------
function validEmail($email)
{
    // Check for exactly 1 @ symbol
    $atCount = substr_count($email, '@');
    if ($atCount !== 1) {
        return 'Email must have one @ symbol';
    }

    // Split email into username and domain parts
    $emailParts = explode('@', $email);
    $username = $emailParts[0];
    $domain = $emailParts[1];

    // Check for missing username
    if (!$username) {
        return 'Missing username part';
    }

    // Check for missing domain
    if (!$domain) {
        return 'Missing domain part';
    }

    // General email validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return 'Invalid email format';
    }

    // No email format errors
    return null;
}

?>