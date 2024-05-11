<?php

// Autlo loading all classes that will be used
require_once __DIR__ . "/../vendor/autoload.php";

use app\Router;
use app\controllers\ProductController;

$router = new Router();

$router->addGet("/", [ProductController::class, "index"]);
$router->addGet("/products", [ProductController::class, "index"]);

$router->addGet("/products/create", [ProductController::class, "create"]);
$router->addPost("/products/create", [ProductController::class, "create"]);

$router->addGet("/products/update", [ProductController::class, "update"]);
$router->addPost("/products/update", [ProductController::class, "update"]);

$router->addGet("/products/delete", [ProductController::class, "delete"]);
$router->addPost("/products/delete", [ProductController::class, "delete"]);

$router->resolve();
