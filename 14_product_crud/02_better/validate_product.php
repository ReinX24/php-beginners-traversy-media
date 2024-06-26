<?php

$title = $_POST["title"];
$description = $_POST["description"];
$price = $_POST["price"];
$imagePath = "";

if (!$title) {
    $errors[] = "Product title is required";
}

if (!$price) {
    $errors[] = "Product price is required";
}

if (!is_dir(__DIR__ . "/public/images")) {
    mkdir(__DIR__ . "/public/images");
}

if (empty($errors)) {
    // Uploading an image
    $image = $_FILES["image"] ?? null;
    $imagePath = $product["image"];

    // Checks if the image exists and if it has a tmp_name (file detected)
    if ($image && $image["tmp_name"]) {

        if ($product["image"]) {
            unlink(__DIR__ . "/public/" . $product["image"]);
        }

        // Creating a unique image path
        $imagePath = "images/" . randomString(8) . "/" . $image["name"];

        // Creating a unique folder for the image
        mkdir(dirname(__DIR__ . "/public/" . $imagePath));

        move_uploaded_file($image["tmp_name"], __DIR__ . "/public/" . $imagePath);
    }
}
