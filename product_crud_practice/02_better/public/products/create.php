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

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    require_once "../../validate_product.php";

    if (empty($errors)) {

        $insert_query =
            "INSERT INTO
                products (title, image, description, price, create_date)
            VALUE
                (:title, :image, :description, :price, :date)";

        $statement = $pdo->prepare($insert_query);

        $statement->bindValue(":title", $title);
        $statement->bindValue(":image", $imagePath);
        $statement->bindValue(":description", $description);
        $statement->bindValue(":price", $price);
        $statement->bindValue(":date", date("Y-m-d H:i:s"));

        $statement->execute();

        // Redirect the user back to the products page
        header("Location: index.php");
    }
}

?>

<?php include_once "../../views/partials/header.php"; ?>

<p><a href="index.php" class="btn btn-secondary">Go Back to Products</a></p>

<h1>Create new Product</h1>

<?php include_once "../../views/products/form.php"; ?>

</body>

</html>