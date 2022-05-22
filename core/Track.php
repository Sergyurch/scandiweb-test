<?php

namespace Core;

class Track
{
    private string $controller;
    private string $action;
    private array $params;

    public function __construct($controller, $action, $params = [])
    {
        $this->controller = $controller;
        $this->action = $action;
        $this->params = $params;
    }

    public function getController(): string
    {
        return $this->controller;
    }

    public function getAction(): string
    {
        return $this->action;
    }

    public function getParams(): array
    {
        return $this->params;
    }
}
