<?php

declare(strict_types=1);

namespace App\Entity;

use App\DB\DatabaseConnector;
use App\Library\SnakeCamelCaseConverterHelper;
use DateTime;

abstract class Entity
{
    protected const TABLE_NAME = '';

    public function __set(string $name, $value): void
    {
        $method = 'set' . SnakeCamelCaseConverterHelper::convertToCamelCase($name);

        if (is_string($value) && strtotime($value)) {
            $value = DateTime::createFromFormat('Y-m-d', $value);
        }

        $this->$method($value);
    }

    public static function findByWithConversion(string $key, mixed $value): ?Entity
    {
        /** @var DatabaseConnector $dbConnector */
        $dbConnector = DatabaseConnector::getInstance();

        return $dbConnector->executeWithConversionToClass(
            static::class,
            "SELECT * FROM " . static::TABLE_NAME . " WHERE $key=:key",
            [':key' => $value],
        );
    }

    public static function existsBy(string $key, mixed $value): bool
    {
        /** @var DatabaseConnector $dbConnector */
        $dbConnector = DatabaseConnector::getInstance();

        return !!$dbConnector->execute(
            "SELECT * FROM " . static::TABLE_NAME . " WHERE $key=:key",
            [':key' => $value],
        );
    }

    public function insert(): void
    {
        /** @var DatabaseConnector $dbConnector */
        $dbConnector = DatabaseConnector::getInstance();

        $columns = [];
        $values = [];

        $reflection = new \ReflectionClass(static::class);
        foreach ($reflection->getProperties() as $property) {
            $name = $property->getName();
            if ('id' === $name) {
                continue;
            }

            $method = 'get' . ucfirst($name);
            $value = $this->$method();
            if (!$value) {
                continue;
            }

            $columns[] = SnakeCamelCaseConverterHelper::convertToSnakeCase($name);
            $values[':' . $name] = $value;
        }

        $sql =
            'INSERT INTO ' . static::TABLE_NAME . '(' . implode(',', $columns) . ')
            VALUES (' . implode(',', array_keys($values)) . ')';

        $dbConnector->execute($sql, $values);
    }

    public function update(): void
    {
        /** @var DatabaseConnector $dbConnector */
        $dbConnector = DatabaseConnector::getInstance();

        $id = null;
        $updateData = [];
        $values = [];

        $reflection = new \ReflectionClass(static::class);
        foreach ($reflection->getProperties() as $property) {
            $name = $property->getName();

            $method = 'get' . ucfirst($name);
            $value = $this->$method();

            if ('id' === $name) {
                $id = $value;
                continue;
            }

            if (!$value) {
                continue;
            }

            if ($value instanceof DateTime) {
                $value = $value->format('Y-m-d');
            }

            $updateData[] = SnakeCamelCaseConverterHelper::convertToSnakeCase($name) . ' = :' . $name;
            $values[':' . $name] = $value;
        }

        $sql =
            'UPDATE ' . static::TABLE_NAME . ' SET ' . implode(',', $updateData) .
            ' WHERE id=' . $id;

        $dbConnector->execute($sql, $values);
    }
}
