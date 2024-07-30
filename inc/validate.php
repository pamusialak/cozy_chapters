<?php
class Validate
{
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

    public function validISBN($isbn)
    {
        // Validate ISBN-10 (10 digits) or ISBN-13 (13 digits)
        return preg_match('/^(?:\d{10}|\d{13})$/', $isbn);
    }

    public function validPages($pages)
    {
        return filter_var($pages, FILTER_VALIDATE_INT, ["options" => ["min_range" => 1]]);
    }

    public function escape_string($data)
    {
        return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    }
}