<?php

declare(strict_types=1);

namespace App\Services\Validator;

abstract class Validator
{
    protected static array $rules = [];
    protected static array $nullableFields = [];

    public function validate(array $data): ?string
    {
        foreach (static::$rules as $fieldName => $rules) {
            $fieldValue = $data[$fieldName] ?? null;

            if (!$fieldValue) {
                if (in_array($fieldName, static::$nullableFields[$fieldName])) {
                    continue;
                }

                return 'field ' . $fieldName . ' can\'t be null';
            }

            foreach ($rules as $rule) {
                if (is_array($rule)) {
                    $error = $this->validateComposite($fieldName, $fieldValue, $rule);
                } else {
                    $error = $this->{'assert' . ucfirst($rule)}($fieldName, $fieldValue);
                }

                if ($error) {
                    return $error;
                }
            }
        }

        return null;
    }

    protected function validateComposite(string $name, mixed $value, array $data): ?string
    {
        foreach ($data as $k => $v) {
            return $this->{'assert' . ucfirst($k)}($name, $value, $v);
        }

        return null;
    }

    protected function assertString(string $name, mixed $value): ?string
    {
        if (!is_string($value)) {
            return  "'$name' parameter should be a string";
        }

        return null;
    }

    protected function assertEmail(string $name, mixed $value): ?string
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            return  "'$name' parameter should be a valid email";
        }

        return null;
    }

    protected function assertMax(string $name, string $value, int $max): ?string
    {
        if ($max < strlen($value)) {
            return  "'$name' should not be longer than $max";
        }

        return null;
    }
}
