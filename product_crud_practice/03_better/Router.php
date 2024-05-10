<?php

declare(strict_types=1);

namespace app;

use app\Database;

class Router
{
    // For different routes to be stored by our browert
    public array $getRoutes = [];
    public array $postRoutes = [];
    public Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function addGet(string $url, array $fn)
    {
        $this->getRoutes[$url] = ["controller" => $fn[0], "method" => $fn[1]];
    }

    public function addPost(string $url, array $fn)
    {
        $this->postRoutes[$url] = $fn;
    }

    public function resolve()
    {
        // Go back to index page if no REQUEST_URI found
        $currentUrl = $_SERVER["REQUEST_URI"] ?? "/";

        // Removing the query string from the currentUrl if there are any
        if (strpos($currentUrl, "?")) {
            $currentUrl = substr($currentUrl, 0, strpos($currentUrl, "?"));
        }

        // Checking if the method is a POST or GET request
        $method = $_SERVER["REQUEST_METHOD"];

        if ($method === "GET") {
            $fn = $this->getRoutes[$currentUrl] ?? null;
        } else {
            $fn = $this->postRoutes[$currentUrl] ?? null;
        }

        if ($fn) {
            // Call the method from the ProductContoller class
            $controller = new $fn["controller"]();
            $method = $fn["method"];
            $controller::$method($this);
            // call_user_func($fn, $this);
        } else {
            echo "Page not found";
        }
    }

    public function renderView($view, $params = [])
    {
        // Converts key value array items into variables and values
        extract($params);

        // Starts buffering, loads the entire page before being sent to browser
        ob_start();

        include_once __DIR__ . "/views/{$view}.php";

        // Get the contents inside the buffer
        $content = ob_get_clean();

        include_once __DIR__ . "/views/_layout.php";
    }
}
