<?php
class Validate
{
    // Check for empty required fields
    public function checkEmpty($data, $requiredFields)
    {
        $msg = null;
        foreach ($requiredFields as $field) {
            if (empty($data[$field])) {
                $msg .= "<p>$field field is empty</p>";
            }
        }
        return $msg;
    }

    // Validate ISBN-10 or ISBN-13
    public function validISBN($isbn)
    {
        // Validate ISBN-10 (10 digits) or ISBN-13 (13 digits)
        return preg_match('/^(?:\d{10}|\d{13})$/', $isbn);
    }

    // Validate number of pages (positive integer)
    public function validPages($pages)
    {
        // Check if pages is a positive integer
        return filter_var($pages, FILTER_VALIDATE_INT, ["options" => ["min_range" => 1]]);
    }

    // Escape string to prevent XSS
    public function escape_string($data)
    {
        return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    }
}
?>
