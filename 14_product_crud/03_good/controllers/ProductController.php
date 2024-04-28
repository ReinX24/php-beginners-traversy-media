<?php

declare(strict_types=1);

namespace app\controllers;

use app\Router;

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
        $product = [
            "title" => "",
            "description" => "",
            "image" => "",
            "price" => "",
        ];

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
        }

        $router->renderView("products/create", [
            "product" => $product,
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
