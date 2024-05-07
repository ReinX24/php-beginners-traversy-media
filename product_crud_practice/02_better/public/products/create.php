<?php

require_once "../../database.php";
require_once "../../functions.php";

$errors = [];

$title = "";
$price = "";
$description = "";

$product = [
    "image" => "",
];

?>

<?php include_once "../../views/partials/header.php"; ?>

<p><a href="index.php" class="btn btn-secondary">Go Back to Products</a></p>

<h1>Create new Product</h1>

<?php include_once "../../views/products/form.php"; ?>

</body>

</html>