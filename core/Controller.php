<?php

namespace Core;

abstract class Controller
{
    protected function render(string $view, array $params, int $code = 200): void
    {
        (new View($view, $params, $code))->renderHtml();
    }
}
