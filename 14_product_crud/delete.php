<?php
$pdo = new PDO(
    "mysql:host=localhost;port=3306;dbname=products_crud",
    "root",
    ""
);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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
