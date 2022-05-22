<?php

namespace Core;

use Project\Exceptions\NotFoundException;

class Router
{
    private string $uri;
    private array $routes;

    public function __construct()
    {
        $this->uri = $_SERVER['REQUEST_URI'];
        $this->routes = require_once $_SERVER['DOCUMENT_ROOT'] . '/project/config/routes.php';
    }

    public function getTrack(): Track
    {
        foreach ($this->routes as $route) {
            $pattern = $this->createPattern($route->getPath());

            if (preg_match($pattern, $this->uri, $params)) {
                unset($params[0]);
                return new Track($route->getController(), $route->getAction(), $params);
            }
        }

        throw new NotFoundException('Page is not found');
    }

    private function createPattern($path): string
    {
        return '#^' . preg_replace('#/:([^/]+)#', '/([^/]+)', $path) . '/?$#';
    }
}
