<?php

declare(strict_types=1);

namespace app\controllers;

use app\Router;
use app\models\Product;

class ProductController
{
    public static function index(Router $router)
    {
        // Get the current search in $_GET
        $search = $_GET["search"] ?? "";
        // Get all the products
        $products = $router->db->getProducts($search);
        $router->renderView("products/index", [
            "products" => $products,
            "search" => $search
        ]);
    }

    public static function create(Router $router)
    {
        $errors = [];
        $productData = [
            "title" => "",
            "description" => "",
            "image" => "",
            "price" => "",
        ];

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $productData["title"] = $_POST["title"];
            $productData["description"] = $_POST["description"];
            $productData["price"] = (float) $_POST["price"];
            $productData["imageFile"] = $_FILES["image"] ?? null;

            $product = new Product();
            $product->load($productData);
            $errors = $product->save();

            if (empty($errors)) {
                header("Location: /products");
                exit;
            }
        }

        $router->renderView("products/create", [
            "product" => $productData,
            "errors" => $errors
        ]);
    }

    public static function update(Router $router)
    {
        echo "Update page";
    }

    public static function delete(Router $router)
    {
        echo "Delete page";
    }
}
