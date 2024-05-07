<?php

// Connecting to the database using a PDO object
$pdo = new PDO(
    "mysql:host=localhost;port=3306;dbname=products_crud",
    "root",
);

// Enable errors for PDO object
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
