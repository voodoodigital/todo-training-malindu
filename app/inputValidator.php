<?php

/**

Validator class is used to validate various inputs based on predefined rules.

This class accepts an object as input containing various key-value pairs, where the keys are

the input names and the values are the actual input values. The keys must match the predefined

keys defined in the class to be validated.

@param object $inputData An object containing the input values to be validated

@method array validator() Validates the input values and returns an array containing the validation results
 */


// parameter1[object] = object which is consist with all the inputs
// you can update the keys to modify more advanced validations 

class Validator
{

    private $data;
    private $errors;
    private $keys = array(
        'username' => true,
        'firstname' => true,
        'lastname' => true,
        'email' => true,
        'slmobile' => true,
    );


    public function __construct($inputData)
    {
        $this->data = $inputData; // should be an object
    }

    public function validator()
    {
        $response = new stdClass();
        $inputArray = get_object_vars($this->data);
        foreach ($inputArray as $key => $value) {
            if (array_key_exists($key, $this->keys)) {
                if ($key == 'username' || $key == 'firstname' || $key == 'lastname') {
                    $response->$key = $this->nameValidator($value);
                } else if ($key == 'email') {
                    $response->$key = $this->emailvalidator($value);
                } else if ($key == 'description') {
                    $response->$key = $this->descriptionValidator($value);
                } else if ($key == 'slmobile') {
                    $response->$key = $this->slMobileValidator($value);
                }
            } else {
                $response->$key = $this->customValidator($value);
            }
        }
        $this->errors = $response;
        return $this->errors;
    }

    public function customValidator($input)
    {
        // Remove whitespace from beginning and end of name
        $input = trim($input);

        // Check if input contains only letters, numbers, underscores, and dashes
        if (!preg_match('/^[a-zA-Z0-9_-]+$/', $input)) {
            // input contains invalid characters
            return "input can only contain letters, numbers, underscores, and dashes.";
        }
    }

    public function nameValidator($name)
    {
        // Remove whitespace from beginning and end of name
        $name = trim($name);

        // Check if name contains only letters, numbers, underscores, and dashes
        if (!preg_match('/^[a-zA-Z0-9_-]+$/', $name)) {
            // name contains invalid characters
            return "name can only contain letters, numbers, underscores, and dashes.";
        }

        // Check if name is between 3 and 20 characters long
        if (strlen($name) < 3 || strlen($name) > 20) {
            // name is too short or too long
            return "name must be between 3 and 20 characters long.";
        }

        // // If name address passes validation, use it
        // return  $name;
    }

    public function emailvalidator($email)
    {
        // Remove whitespace from beginning and end of email address
        $email = trim($email);

        // Check if email address is valid format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Email address is not in valid format
            return "Invalid email address.";
        }

        // // If email address passes validation, use it
        // return  $email;
    }

    public function descriptionValidator($description)
    {
        // Remove whitespace from beginning and end of description
        $description = trim($description);

        // Check if description is between 10 and 500 characters long
        if (strlen($description) < 10 || strlen($description) > 500) {
            // Description is too short or too long
            return "Description must be between 10 and 500 characters long.";
        }
    }

    public function slMobileValidator($mobile)
    {
        $mobile = trim($mobile);

        // Check if mobile is 10 digits long and only contains mobile
        if (!preg_match('/^(01|07)[0-9]{8}$/', $mobile)) {
            // mobile is not in valid format
            return 'Invalid Mobile No';
        }
    }
}


// check for other inputs and validate them according to the instruction given
