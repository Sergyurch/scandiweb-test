<?php

namespace Project\Models;

use Core\Database;
use Core\Model;

class ProductAttribute extends Model
{
    protected int $productId;
    protected int $attributeId;
    protected string $value;

    public function getProductId(): int
    {
        return $this->productId;
    }

    public function setProductId(int $number): void
    {
        $this->productId = $number;
    }

    public function getAttributeId(): int
    {
        return $this->attributeId;
    }

    public function setAttributeId(int $number): void
    {
        $this->attributeId = $number;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function setValue(string $value): void
    {
        $this->value = $value;
    }

    public static function getProductAttributeValue(int $productId, int $attributeId): ?string
    {
        $db = new Database();
        $result = $db->query(
            'SELECT * FROM ' . static::getTableName() . ' WHERE product_id = :value1 AND attribute_id = :value2;',
            [
                ':value1' => $productId,
                ':value2' => $attributeId
            ],
            static::class
        );

        return $result[0]->getValue() ?? null;
    }

    protected static function getTableName(): string
    {
        return 'products_attributes';
    }
}
