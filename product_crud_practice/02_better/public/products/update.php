<?php

require_once "../../database.php";
require_once "../../functions.php";

$id = $_GET["id"] ?? null;

if (!$id) {
    header("Location: index.php");
    exit;
}

$product_query =
    "SELECT
        *
    FROM
        products
    WHERE
        id = :id";

$statement = $pdo->prepare($product_query);

$statement->bindValue(":id", $id);

$statement->execute();

$product = $statement->fetch(PDO::FETCH_ASSOC);

$errors = [];

$title = $product["title"];
$price = $product["price"];
$description = $product["description"];

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    require_once "../../validate_product.php";

    if (empty($errors)) {
        $update_query =
            "UPDATE
                products
            SET
                title = :title, 
                image = :image, 
                description = :description,
                price = :price
            WHERE
                id = :id";

        $statement = $pdo->prepare($update_query);

        $statement->bindValue(":title", $title);
        $statement->bindValue(":image", $imagePath);
        $statement->bindValue(":description", $description);
        $statement->bindValue(":price", $price);
        $statement->bindValue(":id", $id);

        $statement->execute();

        header("Location: index.php");
    }
}

?>

<?php include_once "../../views/partials/header.php"; ?>

<p><a href="index.php" class="btn btn-secondary">Go Back to Products</a></p>

<h1>Update Product <b><?= $product["title"] ?></b></h1>

<?php include_once "../../views/products/form.php"; ?>

</body>

</html>