<?php

namespace app\models;

use app\Database;

class Product
{
    public ?int $id = null;
    public ?string $title = null;
    public ?string $description = null;
    public ?float $price = null;
    public ?string $imagePath = null;
    public ?array $imageFile = null;

    public function load($data)
    {
        $this->id = $data["id"] ?? null;
        $this->title = $data["title"]; // required so cannot be null
        $this->description = $data["description"] ?? ""; // required
        $this->price = $data["price"]; // required
        $this->imageFile = $data["imageFile"] ?? null;
        $this->imagePath = $data["image"] ?? null;
    }

    public function save()
    {
        $errors = [];

        // No title
        if (!$this->title) {
            $errors[] = "Product title is required.";
        }

        // No price
        if (!$this->price) {
            $errors[] = "Product price is required.";
        }

        if (!is_dir(__DIR__ . "/../public/images")) {
            mkdir(__DIR__ . "/../public/images");
        }

        if (empty($errors)) {
            // Uploading an image
            // Checks if the image exists and if it has a tmp_name (file detected)
            if ($this->imageFile && $this->imageFile["tmp_name"]) {

                if ($this->imagePath) {
                    unlink(__DIR__ . "/../public/" . $this->imagePath);
                }

                // Creating a unique image path
                $this->imagePath = "images/" . randomString(8) . "/" . $this->imageFile["name"];

                // Creating a unique folder for the image
                mkdir(dirname(__DIR__ . "/../public/" . $this->imagePath));

                move_uploaded_file($this->imageFile["tmp_name"], __DIR__ . "/../public/" . $this->imagePath);
            }

            $db = Database::$db;

            if ($this->id) {
                // Update
                $db->updateProduct($this);
            } else {
                // Create a new product
                $db->createProduct($this);
            }
        }

        return $errors;
    }
}
