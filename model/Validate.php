<?php
// ------------------------------------------------------------------------------
// Data validation for all form fields
// ------------------------------------------------------------------------------

require_once 'Form.php';

class Validate
{
    private $form; // Form object to validate

    // ------------------------------------------------------------------------------
    // Constructor
    // ------------------------------------------------------------------------------
    public function __construct($form)
    {
//        $this->form = new Form();
        $this->form = $form;
    }
    
    // ------------------------------------------------------------------------------
    // Validate text field's length and required status.
    // Min and max are 1 and 50 by default, respectively.
    // Required is true by default.
    // ------------------------------------------------------------------------------
    public function text($name, $value, $required = true, $min = 1, $max = 50)
    {
        // Get the Field object by name
        $field = $this->form->getField($name);

        // Check if field is required (clear error and exit validation if not required)
        if (!$required && (empty($value) || strlen(trim($value)) === 0)) {
            $field->clearError();
            return;
        }

        // Check if field is empty
        if (empty($value) || strlen(trim($value)) === 0) {
            $field->setError('Required');
        } // Check field length
        elseif (strlen($value) < $min || strlen($value) > $max) {
            $err_msg = "Must be $min to $max characters";
            $field->setError($err_msg);
        } // No errors (clear errors for the field in case it previously had an error)
        else {
            $field->clearError();
        }
    }

    // ------------------------------------------------------------------------------
    // Pattern match helper function to validate email, phone, and version patterns
    // ------------------------------------------------------------------------------
    public function patternMatch($pattern, $value)
    {
        $match = preg_match($pattern, $value);
        if ($match != 1) {
            return false;
        } else {
            return true;
        }
    }

    // ------------------------------------------------------------------------------
    // Validate email. Required is true by default.
    // ------------------------------------------------------------------------------
    public function email($name, $value, $required = true)
    {
        // Get the Field object by name
        $field = $this->form->getField($name);

        // Check if field is required (clear error and exit validation if not required)
        if (!$required && empty($value)) {
            $field->clearError();
            return;
        }

        // Check if value is empty
        if (empty($value)) {
            $field->setError('Required');
            return;
        }

        // Check for exactly 1 @ symbol
        if (substr_count($value, '@') !== 1) {
            $field->setError('Email must have one @ symbol');
            return;
        }

        // Split email into username and domain parts
        list($username, $domain) = explode('@', $value);
        $domainPattern = '/^[a-zA-Z0-9]{2,}\.[a-zA-Z]{2,}$/';

        // Check if username is empty
        if (empty($username)) {
            $field->setError('Username is missing');
        } // Check if domain is empty
        elseif (empty($domain)) {
            $field->setError('Domain is missing');
        } // Check domain pattern
        elseif (!$this->patternMatch($domainPattern, $domain)) {
            $field->setError('Invalid domain format');
        } // General email validation
        elseif (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $field->setError('Invalid email');
        } // No errors (clear errors for the field in case it previously had an error)
        else {
            $field->clearError();
        }
    }

    // ------------------------------------------------------------------------------
    // Validate phone. Required is true by default
    // ------------------------------------------------------------------------------
    public function phone($name, $value, $pattern, $example, $required = true, $min = 7, $max = 20)
    {
        // Get the Field object by name
        $field = $this->form->getField($name);

        // Check if field is required (clear error and exit validation if not required)
        if (!$required && empty($value)) {
            $field->clearError();
            return;
        }

        // Check if value is empty
        if (empty($value)) {
            $field->setError('Required');
            return;
        }

        // Check length
        if (strlen($value) < $min || strlen($value) > $max) {
            $field->setError("Phone number must be $min to $max digits");
        } // Check phone pattern
        elseif (!$this->patternMatch($pattern, $value)) {
            $field->setError("Phone format: $example");
        } // No errors (clear errors for the field in case it previously had an error)
        else {
            $field->clearError();
        }
    }

    // ------------------------------------------------------------------------------
    // Validate version. Required is true by default
    // ------------------------------------------------------------------------------
    public function version($name, $value, $pattern, $example, $required = true)
    {
        // Get the Field object by name
        $field = $this->form->getField($name);

        // Check if field is required (clear error and exit validation if not required)
        if (!$required && empty($value)) {
            $field->clearError();
            return;
        }

        // Check if value is empty
        if (empty($value)) {
            $field->setError('Required');
        } // Check version pattern
        elseif (!$this->patternMatch($pattern, $value)) {
            $field->setError("Version format: $example");
        } // No errors (clear errors for the field in case it previously had an error)
        else {
            $field->clearError();
        }
    }

    // ------------------------------------------------------------------------------
    // Validate date. Required is true by default
    // ------------------------------------------------------------------------------
    public function date($name, $value, $required = true)
    {
        // Get the Field object by name
        $field = $this->form->getField($name);

        // Check if field is required (clear error and exit validation if not required)
        if (!$required && empty($value)) {
            $field->clearError();
            return;
        }

        // Check if field is empty
        if (empty($value)) {
            $field->setError('Required');
        } // Check if date string can be formatted as a DateTime object
        elseif (strlen($value) === 1 || !date_create($value)) {
            $field->setError('Invalid date format');
        } else {
            // No date errors
            $field->clearError();
        }
    }
}

?>