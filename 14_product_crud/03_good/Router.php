<?php

declare(strict_types=1);

namespace app;

class Router
{
    public array $getRoutes = [];
    public array $postRoutes = [];

    public function get(string $url, array $fn)
    {
        $this->getRoutes[$url] = $fn;
    }

    public function post(string $url, array $fn)
    {
        $this->postRoutes[$url] = $fn;
    }

    public function resolve()
    {
        // Checks the current PATH_INFO, return index if path does not exist.
        // When we go to the index, the PATH_INFO does not exist so the / is
        // assigned as the current url, which stores the index.
        $currentUrl = $_SERVER["PATH_INFO"] ?? "/";
        $method = $_SERVER["REQUEST_METHOD"];

        if ($method === "GET") {
            $fn = $this->getRoutes[$currentUrl] ?? null;
        } else {
            $fn = $this->postRoutes[$currentUrl] ?? null;
        }

        if ($fn) {
            // Calling a method from the controller
            // $controller = new $fn[0]();
            // $method = $fn[1];
            // $controller->$method();

            // Another way of calling the method from the controller
            call_user_func($fn, $this);
        } else {
            echo "Page not found";
        }
    }

    public function renderView($view) // products/index
    {
        include_once __DIR__ . "/views/{$view}.php";
    }
}
