<?php

use Core\Route;

return [
    new Route('/', 'ProductController', 'showAll'),
    new Route('/product/delete', 'ProductController', 'delete'),
    new Route('/add-product', 'ProductController', 'add')
];
