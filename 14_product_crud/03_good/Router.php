<?php

declare(strict_types=1);

namespace app;

class Router
{
    public array $getRoutes = [];
    public array $postRoutes = [];
    public Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }

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

    public function renderView($view, $params = [])
    {
        // Iterating over the parameters
        // $$key = $value means that we make the key into a variable that will
        // contain the contents of $value.
        // foreach ($params as $key => $value) {
        //     $$key = $value;
        // }

        // The extract method converts the keys in an associative array into
        // variables and the values into the values of the newly made variable.
        extract($params);

        // Makes sure that all content is loaded before being sent to the
        // browser. This is saved in the buffer which is to be loaded.
        ob_start();
        include_once __DIR__ . "/views/{$view}.php";

        // Returns the contents in the buffer and cleans that buffer.
        $content = ob_get_clean();

        // Including the layout of our webpage.
        include_once __DIR__ . "/views/_layout.php";
    }
}
