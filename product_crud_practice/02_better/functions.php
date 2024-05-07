<?php
function randomString($strLen)
{
    $characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $randomstr = "";
    for ($i = 0; $i < $strLen; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomstr .= $characters[$index];
    }

    return $randomstr;
}
