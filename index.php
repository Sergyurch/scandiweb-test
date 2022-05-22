<?php

use Core\Router;
use Core\Dispatcher;
use Core\View;
use Project\Exceptions\DbException;
use Project\Exceptions\NotFoundException;

try {
    spl_autoload_register(function ($class) {
        preg_match('#(.+)\\\\(.+)$#', $class, $match);
        $nameSpace = str_replace('\\', DIRECTORY_SEPARATOR, strtolower($match[1]));
        $className = $match[2];

        $path = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . $nameSpace .
            DIRECTORY_SEPARATOR . $className . '.php';

        require_once $path;
    });

    $track = (new Router())->getTrack();
    Dispatcher::runController($track);
} catch (DbException $e) {
    $view = (new View(
        'error/error',
        [
            'layout' => 'errorLayout',
            'title' => 'Database connection error',
            'message' => $e->getMessage()
        ],
        500
    ));
    $view->renderHtml();
} catch (NotFoundException $e) {
    $view = (new View(
        'error/error',
        [
            'layout' => 'errorLayout',
            'title' => 'Page is not found',
            'message' => $e->getMessage()
        ],
        404
    ));
    $view->renderHtml();
}
