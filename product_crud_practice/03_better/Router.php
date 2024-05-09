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
}
