<?php

$title = $_POST["title"];
$description = $_POST["description"];
$price = $_POST["price"];
$imagePath = "";

// Adds errors if the product title or price is empty
if (!$title) {
    $errors["title_error"] = "Product title is required";
}

if (!$price) {
    $errors["price_error"] = "Product price is required";
}

// Checks if the images directory already exists
if (!is_dir(__DIR__ . "/public/images")) {
    mkdir(__DIR__ . "/public/images");
}

// If there are no errors, upload the image to the database
if (empty($errors)) {

    // Getting the image
    $image = $_FILES["image"] ?? null;
    // Get the imagePath from product, returns a path if the image exists
    $imagePath = $product["image"];

    // Checks if the image exists and if it has a tmp_name (file detected)
    if ($image && $image["tmp_name"]) {

        // If a current image exists, replace that image with the new image
        if ($product["image"]) {
            unlink(__DIR__ . "/public/" . $product["image"]);
        }

        // Creating a new unique imagePath
        $imagePath = "images/" . randomString(8) . "/" . $image["name"];

        // Creating a folder for the new image
        mkdir(dirname(__DIR__ . "/public/" . $imagePath));

        move_uploaded_file($image["tmp_name"], __DIR__ . "/public/" . $imagePath);
    }
}
