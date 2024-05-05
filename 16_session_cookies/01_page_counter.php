<?php

session_start();

// Creating a page counter
$_SESSION["page_counter"] = $_SESSION["page_counter"] ?? 0;
$_SESSION["page_counter"]++;

$pageCounter = $_SESSION["page_counter"] ?? 0;

if ($_SESSION["page_counter"] == 10) {
    echo "Thanks for visiting us 10 times <br>";
    session_unset();
    session_destroy(); // ends the session
}

// echo session_id();

// $_SESSION["name"] = "Zura";

// echo "<pre>";
// var_dump($_SESSION);
// echo "</pre>";

// Removes variable from a session
// unset($_SESSION["name"]);

// Removes all variables in a session
// session_unset();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>My Awesome Page, Visited <?= $pageCounter ?> times</h1>
</body>

</html>