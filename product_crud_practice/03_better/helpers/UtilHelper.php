<?php

declare(strict_types=1);

namespace app\helpers;

class UtilHelper
{
    // Function for creating a random string
    public static function randomString(int $strLen): string
    {
        $characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $randomStr = "";
        for ($i = 0; $i < $strLen; $i++) {
            $index = rand(0, strlen($characters) - 1); // random index
            $randomStr .= $characters[$index]; // appending to string
        }

        return $randomStr;
    }
}
