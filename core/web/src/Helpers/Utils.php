<?php
namespace Web\Helpers;

class Utils
{
    public static function formatCurrency($input) {
        if(is_numeric($input)) {
            return number_format($input, 0, ',', '.') . '₫';
        }
        return $input;
    }
}
