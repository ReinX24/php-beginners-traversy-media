<?php

namespace app\models;

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

        // 
    }
}
