<?php

namespace Core;

abstract class Model
{
    protected int $id;

    public function getId(): int
    {
        return $this->id;
    }

    public function __set(string $name, $value)
    {
        $camelCaseName = $this->underscoreToCamelCase($name);
        $this->$camelCaseName = $value;
    }

    public static function findAll(): array
    {
        $db = new Database();
        return $db->query('SELECT * FROM ' . static::getTableName() . ';', [], static::class);
    }

    public static function getById(int $id): ?static
    {
        $db = new Database();
        $entities = $db->query(
            'SELECT * FROM ' . static::getTableName() . ' WHERE id=:id;',
            [':id' => $id],
            static::class
        );

        return $entities ? $entities[0] : null;
    }

    public static function deleteMultipleById(array $list): void
    {
        $db = new Database();
        $list = implode(',', $list);

        $db->query('DELETE FROM ' . static::getTableName() . ' WHERE id IN (' . $list . ');');
    }

    public static function findOneByColumn(string $columnName, $value): ?static
    {
        $db = new Database();
        $result = $db->query(
            'SELECT * FROM ' . static::getTableName() . ' WHERE ' . $columnName . ' = :value LIMIT 1;',
            [':value' => $value],
            static::class
        );

        if ($result === []) {
            return null;
        }

        return $result[0];
    }

    public function insert(): void
    {
        $mappedProperties = $this->mapPropertiesToDbFormat();

        $columns = [];
        $paramsNames = [];
        $params2values = [];
        foreach ($mappedProperties as $columnName => $value) {
            $columns[] = '`' . $columnName . '`';
            $paramName = ':' . $columnName;
            $paramsNames[] = $paramName;
            $params2values[$paramName] = $value;
        }

        $columnsViaSemicolon = implode(', ', $columns);
        $paramsNamesViaSemicolon = implode(', ', $paramsNames);

        $sql = 'INSERT INTO ' . static::getTableName() . ' (' . $columnsViaSemicolon . ') 
            VALUES (' . $paramsNamesViaSemicolon . ');';

        $db = new Database();
        $db->query($sql, $params2values, static::class);
        $this->id = $db->getLastInsertId();
    }

    abstract protected static function getTableName(): string;

    private function mapPropertiesToDbFormat(): array
    {
        $properties = get_object_vars($this);
        $mappedProperties = [];

        foreach ($properties as $key => $value) {
            $propertyName = $key;
            $propertyNameAsUnderscore = $this->camelCaseToUnderscore($propertyName);
            $mappedProperties[$propertyNameAsUnderscore] = $value;
        }

        return $mappedProperties;
    }

    private function camelCaseToUnderscore(string $source): string
    {
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $source));
    }

    private function underscoreToCamelCase(string $source): string
    {
        return lcfirst(str_replace('_', '', ucwords($source, '_')));
    }
}
