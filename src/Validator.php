<?php

namespace Hexlet\Validator;

use Exception;

class Validator
{
    private array $checkList = [
        'string' => StringCheck::class,
        'number' => NumberCheck::class,
        'array' => ArrayCheck::class
    ];

    private array $customValidation;

    public function string(): StringCheck
    {
        $customValidationList = $this->customValidation['string'] ?? [];
        return new StringCheck($customValidationList);
    }

    public function number(): NumberCheck
    {
        $customValidationList = $this->customValidation['number'] ?? [];
        return new NumberCheck($customValidationList);
    }

    public function array(): ArrayCheck
    {
        $customValidationList = $this->customValidation['array'] ?? [];
        return new ArrayCheck($customValidationList);
    }

    public function addValidator(string $type, string $name, callable $fn): void
    {
        $typeClass = $this->checkList[$type] ?? null;

        if ($typeClass === null) {
            throw new Exception('boom!');
        }

        $this->customValidation[$type][$name] = new CustomValidator($name, $fn);
    }
}
