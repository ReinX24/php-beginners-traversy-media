<?php
$pdo = new PDO(
    "mysql:host=localhost;port=3306;dbname=products_crud",
    "root",
    ""
);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$id = $_GET["id"] ?? null;

if (!$id) {
    header("Location: index.php");
    exit;
}

$update_query =
    "SELECT
        *
    FROM
        products
    WHERE
        id = :id";

$statement = $pdo->prepare($update_query);

$statement->bindValue(":id", $id);

$statement->execute();

$product = $statement->fetch(PDO::FETCH_ASSOC);

$errors = [];

$title = $product["title"];
$price = $product["price"];
$description = $product["description"];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = $_POST["title"];
    $description = $_POST["description"];
    $price = $_POST["price"];

    if (!$title) {
        $errors[] = "Product title is required";
    }

    if (!$price) {
        $errors[] = "Product price is required";
    }

    if (!is_dir("images")) {
        mkdir("images");
    }

    if (empty($errors)) {
        // Uploading an image
        $image = $_FILES["image"] ?? null;
        $imagePath = $product["image"];

        // Checks if the image exists and if it has a tmp_name (file detected)
        if ($image && $image["tmp_name"]) {

            // Delete the recorded image for a product when a new image is
            // uploaded
            if ($product["image"]) {
                unlink($product["image"]); // removes image
            }

            // Creating a unique image path
            $imagePath = "images/" . randomString(8) . "/" . $image["name"];

            // Creating a unique folder for the image
            mkdir(dirname($imagePath));

            move_uploaded_file($image["tmp_name"], $imagePath);
        }

        $update_query =
            "UPDATE 
                products 
            SET 
                title = :title, image = :image, description = :description, 
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

        // Redirect the user to the index page
        header("Location: index.php");
    }
}

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
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="app.css">

    <title>Products CRUD</title>
</head>

<body>

    <p><a href="index.php" class="btn btn-secondary">Go Back to Products</a></p>

    <h1>Update Product <b><?= $product["title"]; ?></b></h1>

    <?php if (!empty($errors)) : ?>
        <div class="alert alert-danger">
            <?php foreach ($errors as $error) : ?>
                <div><?= $error; ?></div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data">

        <?php if ($product["image"]) : ?>
            <img src="<?= $product["image"]; ?>" class="update-image">
        <?php endif; ?>

        <div class="mb-3">
            <label class="form-label">Product Image</label>
            <br>
            <input class="form-control" type="file" name="image">
        </div>
        <div class="mb-3">
            <label class="form-label">Product Title</label>
            <input type="text" name="title" class="form-control" value="<?= $title; ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Product Description</label>
            <textarea class="form-control" name="description"><?= $description; ?></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Product Price</label>
            <input type="number" step="0.01" name="price" class="form-control" value="<?= $price; ?>">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</body>

</html>