<?php

namespace App\VXCase;

class Functions
{
    public function convertValue($value)
    {
        $value = trim($value);
        $value = str_replace(".", "", $value);
        $value = str_replace(",", ".", $value);
        $value = str_replace("-", "", $value);
        $value = str_replace("/", "", $value);
        $value = str_replace("(", "", $value);
        $value = str_replace(")", "", $value);
        $value = str_replace(" ", "", $value);
        return $value;
    }
}
