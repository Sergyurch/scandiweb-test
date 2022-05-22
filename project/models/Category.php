<?php

namespace Project\Models;

use Core\Model;

class Category extends Model
{
    protected string $name;
    protected string $mainAttributeId;

    public function getName(): string
    {
        return $this->name;
    }

    public function getMainAttribute(): Attribute
    {
        return Attribute::getById($this->mainAttributeId);
    }

    protected static function getTableName(): string
    {
        return 'categories';
    }
}
