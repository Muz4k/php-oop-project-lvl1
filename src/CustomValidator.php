<?php

namespace Hexlet\Validator;

class CustomValidator
{
    private string $name;
    private $fn;
    private $constraint;

    public function __construct(string $name, callable $fn)
    {
        $this->name = $name;
        $this->fn = $fn;
    }

    public function test($constraint)
    {
        $this->constraint = $constraint;
    }

    public function isValid($value): bool
    {
        return ($this->fn)($value, $this->constraint);
    }
}
