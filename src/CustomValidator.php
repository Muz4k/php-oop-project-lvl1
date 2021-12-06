<?php

namespace Hexlet\Validator;

use Closure;

class CustomValidator
{
    private string $name;
    private Closure $fn;
    private mixed $constraint;

    public function __construct(string $name, Closure $fn)
    {
        $this->name = $name;
        $this->fn = $fn;
    }

    public function test(mixed $constraint)
    {
        $this->constraint = $constraint;
    }

    public function isValid(mixed $value): bool
    {
        return ($this->fn)($value, $this->constraint);
    }
}
