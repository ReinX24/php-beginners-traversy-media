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
}
