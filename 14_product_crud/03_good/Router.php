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
        echo "<pre>";
        var_dump($_SERVER);
        echo "</pre>";
    }
}
