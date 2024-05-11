<?php

declare(strict_types=1);

namespace app\controllers;

use app\Router;
use app\models\Product;

class ProductController
{
    public static function index(Router $router)
    {
        // Get the search in $_GET, for searching products
        $search = $_GET["search"] ?? "";
        // Get the products similar to $search
        $products = $router->db->getProducts($search);
        $router->renderView(
            "products/index",
            [
                "products" => $products,
                "search" => $search
            ]
        );
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

        // Render view and show if there are any errors
        $router->renderView("products/create", [
            "product" => $productData,
            "errors" => $errors
        ]);
    }

    public static function update(Router $router)
    {
        $id = (int) $_GET["id"] ?? null;

        if (!$id) {
            header("Location: /products");
        }

        $errors = [];

        $productData = $router->db->getProductById($id);

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

        $router->renderView("products/update", [
            "product" => $productData,
            "errors" => $errors
        ]);
    }

    public static function delete(Router $router)
    {
        $id = (int) $_GET["id"] ?? null;

        if (!$id) {
            header("Location: /products");
            exit;
        }

        $productData = $router->db->getProductById($id);

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $router->db->deleteProduct($id);
            header("Location: /products");
            exit;
        }

        $router->renderView("products/delete", [
            "product" => $productData
        ]);
    }
}
