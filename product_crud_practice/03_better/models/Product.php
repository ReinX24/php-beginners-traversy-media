<?php

declare(strict_types=1);

namespace app\models;

use app\Database;
use app\helpers\UtilHelper;

class Product
{
    // Nullable variables that our Product object will have
    public ?int $id = null;
    public ?string $title = null;
    public ?string $description = null;
    public ?float $price = null;
    public ?string $imagePath = null;
    public ?array $imageFile = null;

    // Loading data from a data associative array
    public function load(array $data)
    {
        // Required values cannot be null;
        $this->id = $data["id"] ?? null;
        $this->title = $data["title"]; // required
        $this->description = $data["description"] ?? ""; // required
        $this->price = $data["price"]; // required
        $this->imageFile = $data["imageFile"] ?? null;
        $this->imagePath = $data["image"] ?? null;
    }

    // Saving a Product object to our database
    public function save()
    {
        $errors = [];

        // No title error
        if (!$this->title) {
            $errors["title_error"] = "Product title is required.";
        }

        // No price error
        if (!$this->price) {
            $errors["price_error"] = "Product price is required.";
        }

        // Checks if public/images folder exists
        if (!is_dir(__DIR__ . "public/image")) {
            mkdir(__DIR__ . "/../public/images");
        }

        // Add / Update Product object to our database

        if (empty($errors)) {
            // Checks if the image exists
            // When updating and an image is present, replace the old image
            // with the new image
            if ($this->imageFile && $this->imageFile["tmp_name"]) {
                // Updating curent image
                if ($this->imagePath) {
                    unlink(__DIR__ . "/../public/images" . $this->imagePath);
                }

                // Creating a unique image path using randomString function
                $this->imagePath = "images/" . UtilHelper::randomString(8) . "/" . $this->imageFile["name"];

                // Creating a unique folder for the image
                mkdir(dirname(__DIR__ . "/../public/" . $this->imagePath));

                move_uploaded_file($this->imageFile["tmp_name"], __DIR__ . "/../public/" . $this->imagePath);
            }

            // Uploading / updating Product object in database
            $db = Database::$db;

            if ($this->id) {
                // Update Product object
                $db->updateProduct($this);
            } else {
                $db->createProduct($this);
            }
        }

        return $errors; // return errors, if there are any
    }
}
