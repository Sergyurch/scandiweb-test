<?php

namespace Project\Models;

use Core\Model;

class Product extends Model
{
    protected string $sku;
    protected string $name;
    protected float $price;
    protected int $categoryId;

    public function getSKU(): string
    {
        return $this->sku;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getCategory(): Category
    {
        return Category::getById($this->categoryId);
    }

    public function setCategoryId(string $name): void
    {
        $this->categoryId = Category::findOneByColumn('name', $name)->getId();
    }

    public function getMainAttributeValue(): string
    {
        return ProductAttribute::getProductAttributeValue($this->id, $this->getCategory()->getMainAttribute()->getId());
    }

    public static function createFromArray(array $fields): Product
    {
        $product = new Product();
        $product->sku = $fields['sku'];
        $product->name = $fields['name'];
        $product->price = $fields['price'];
        $product->setCategoryId($fields['type']);
        $product->insert();

        return $product;
    }

    public function insert(): void
    {
        parent::insert();

        $productAttribute = new ProductAttribute();
        $productAttribute->setProductId($this->getId());
        $productAttribute->setAttributeId($this->getCategory()->getMainAttribute()->getId());

        if ($_POST['type'] === 'Furniture') {
            $dimension = $_POST['height'] . 'x' . $_POST['width'] . 'x' . $_POST['length'];
            $productAttribute->setValue($dimension);
        } else {
            $attributeName = strtolower($this->getCategory()->getMainAttribute()->getName());
            $productAttribute->setValue($_POST[$attributeName]);
        }

        $productAttribute->insert();
    }

    protected static function getTableName(): string
    {
        return 'products';
    }
}
