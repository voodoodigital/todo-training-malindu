<?php


class Senitisor
{
    function sanitizeInput($input)
    {
        // Remove HTML tags and encode special characters
        $sanitizedInput = htmlspecialchars(strip_tags($input), ENT_QUOTES | ENT_HTML5);

        // Remove backslashes (\)
        $sanitizedInput = stripslashes($sanitizedInput);

        // Remove leading/trailing whitespace
        $sanitizedInput = trim($sanitizedInput);

        // Convert special characters to HTML entities
        $sanitizedInput = htmlentities($sanitizedInput, ENT_QUOTES | ENT_HTML5, 'UTF-8');

        return $sanitizedInput;
    }

    function senitizeOutput($output)
    {
        // Output encoded string
        return htmlspecialchars($output, ENT_QUOTES, 'UTF-8');
    }
}
