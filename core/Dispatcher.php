<?php

namespace Core;

class Dispatcher
{
    public static function runController(Track $track): void
    {
        $fullControllerName = "\\Project\\Controllers\\{$track->getController()}";
        $action = $track->getAction();
        $params = $track->getParams();

        (new $fullControllerName())->$action(...$params);
    }
}
