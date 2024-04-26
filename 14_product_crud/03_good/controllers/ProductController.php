<?php

declare(strict_types=1);

namespace app\controllers;

use app\Router;

class ProductController
{
    public static function index(Router $router)
    {
        $router->renderView("products/index");
    }

    public static function create()
    {
        echo "Create page";
    }

    public static function update()
    {
        echo "Update page";
    }

    public static function delete()
    {
        echo "Delete page";
    }
}
