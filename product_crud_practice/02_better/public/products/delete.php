<?php

require_once "../../database.php";

$id = $_GET["id"];

if (!$id) {
    header("Location: index.php");
    exit;
}

$confirmDelete = $_POST["submit"] ?? null;

if ($confirmDelete) {
    // Delete the product
    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";

    $delete_query =
        "DELETE FROM
            products
        WHERE
            id = :id";

    $statement = $pdo->prepare($delete_query);

    $statement->bindValue(":id", $id);

    $statement->execute();

    header("Location: index.php");
} else {
    $product_query =
        "SELECT 
            title
        FROM
            products
        WHERE
            id = :id";

    $statement = $pdo->prepare($product_query);

    $statement->bindValue(":id", $id);

    $statement->execute();
    $product = $statement->fetch(PDO::FETCH_ASSOC);
}

?>

<?php include_once "../../views/partials/header.php"; ?>

<p><a href="index.php" class="btn btn-secondary">Go Back to Products</a></p>

<h1>Delete Product</h1>

<p>Are you sure you want to delete <?= $product["title"]; ?>?</p>

<div class="d-flex gap-2">
    <form method="POST">
        <input type="hidden" name="id" value="<?= $_GET["id"]; ?>">
        <button type="submit" name="submit" value="confirm" class="btn btn-outline-danger">Delete</button>
    </form>

    <p><a href="index.php" class="btn btn-outline-secondary">Cancel</a></p>
</div>

</body>

</html>