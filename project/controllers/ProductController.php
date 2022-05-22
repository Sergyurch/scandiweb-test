<?php

namespace Project\Controllers;

use Core\Controller;
use Project\Models\Product;

class ProductController extends Controller
{
    public function showAll(): void
    {
        $products = Product::findAll();

        $this->render('product/showAll', [
            'layout' => 'mainLayout',
            'title' => 'All products',
            'products' => $products
        ]);
    }

    public function add(): void
    {
        if (!empty($_POST)) {
            Product::createFromArray($_POST);
            header('Location: /');
            exit();
        }

        $this->render('product/add', [
            'layout' => 'mainLayout',
            'title' => 'Add product'
        ]);
    }

    public function delete(): void
    {
        if ($_POST['id_array']) {
            Product::deleteMultipleById($_POST['id_array']);
        }

        header('Location: /');
        exit();
    }
}
