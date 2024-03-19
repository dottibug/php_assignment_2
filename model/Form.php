<?php
// ------------------------------------------------------------------------------
// Represents a form field (message parameter can be used for field error messages)
// ------------------------------------------------------------------------------
class Field
{
    private $name, $message;
    private $hasError = false;

    // ------------------------------------------------------------------------------
    // Constructor
    // ------------------------------------------------------------------------------
    public function __construct($name, $message = '')
    {
        $this->name = $name;
        $this->message = $message;
    }

    // ------------------------------------------------------------------------------
    // Get field name
    // ------------------------------------------------------------------------------
    public function getName()
    {
        return $this->name;
    }

    // ------------------------------------------------------------------------------
    // Get field message
    // ------------------------------------------------------------------------------
    public function getMessage()
    {
        return $this->message;
    }

    // ------------------------------------------------------------------------------
    // Get field error status
    // ------------------------------------------------------------------------------
    public function hasError()
    {
        return $this->hasError;
    }

    // ------------------------------------------------------------------------------
    // Get HTML markup for error message
    // ------------------------------------------------------------------------------
    public function getErrorHTML()
    {
        return '<p class="error">' . $this->message . '</p>';
    }

    // ------------------------------------------------------------------------------
    // Set error message for the field
    // ------------------------------------------------------------------------------
    public function setError($message)
    {
        $this->hasError = true;
        $this->message = $message;
    }

    // ------------------------------------------------------------------------------
    // Clear error message for the field
    // ------------------------------------------------------------------------------
    public function clearError()
    {
        $this->hasError = false;
        $this->message = '';
    }
}

// ------------------------------------------------------------------------------
// Represents a form. Creates an array of Field objects within the form.
// ------------------------------------------------------------------------------
class Form
{
    private $fields = array(); // Array of fields in the form

    // ------------------------------------------------------------------------------
    // Constructor
    // ------------------------------------------------------------------------------
    public function __construct()
    {
    }

    // ------------------------------------------------------------------------------
    // Get form fields array
    // ------------------------------------------------------------------------------
    public function getFormFields()
    {
        return $this->fields;
    }

    // ------------------------------------------------------------------------------
    // Add field to the form
    // ------------------------------------------------------------------------------
    public function addField($name, $message = '')
    {
        $field = new Field($name, $message);
        $fieldName = $field->getName();
        $this->fields[$fieldName] = $field;
    }

    // ------------------------------------------------------------------------------
    // Get form field by name
    // ------------------------------------------------------------------------------
    public function getField($name)
    {
        return $this->fields[$name];
    }

    // ------------------------------------------------------------------------------
    // Check whether the form has any fields with errors
    // ------------------------------------------------------------------------------
    public function hasErrors()
    {
        foreach ($this->fields as $field) {
            if ($field->hasError()) {
                return true;
            }
        }
        return false;
    }
}

?>