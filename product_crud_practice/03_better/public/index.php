<?php

// Autlo loading all classes that will be used
require_once __DIR__ . "/../vendor/autoload.php";

use app\Router;
use app\controllers\ProductController;

$router = new Router();

$router->addGet("/", [ProductController::class, "index"]);
$router->addGet("/products", [ProductController::class, "index"]);

$router->resolve();
