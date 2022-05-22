<?php

namespace Project\Models;

use Core\Model;

class Attribute extends Model
{
    protected string $name;
    protected string $unit;

    public function getName(): string
    {
        return $this->name;
    }

    public function getUnit(): string
    {
        return $this->unit;
    }

    protected static function getTableName(): string
    {
        return 'attributes';
    }
}
