<?php

/** @var $pdo \PDO */
require_once "../../database.php";

$id = $_POST["id"] ?? null;

if (!$id) {
    header("Location: index.php");
    exit;
}

$delete_query =
    "DELETE FROM
        products
    WHERE
        id = :id";

$statement = $pdo->prepare($delete_query);

$statement->bindValue(":id", $id);

$statement->execute();

header("Location: index.php");
