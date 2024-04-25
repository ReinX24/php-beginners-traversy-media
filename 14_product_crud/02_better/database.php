<?php

$pdo = new PDO(
    "mysql:host=localhost;port=3306;dbname=products_crud",
    "root",
    ""
);

// Show and throw if there are any errors
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
