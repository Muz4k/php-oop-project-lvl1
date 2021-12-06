<?php

namespace Hexlet\Validator;

use Exception;

class StringCheck
{
    private bool $isRequire = false;
    private int $minLength = 0;
    private string $contains = '';
    private array $customValidation = [];
    private array $activateCustomValidation = [];

    public function __construct($customValidation = [])
    {
        $this->customValidation = $customValidation;
    }

    public function isValid(?string $string): bool
    {
        return
            $this->checkRequire($string)
            && $this->checkContains($string)
            && $this->checkMinLength($string)
            && $this->checkCustom($string);
    }

    public function required(): self
    {
        $this->isRequire = true;

        return $this;
    }

    public function contains(string $string): self
    {
        $this->contains = $string;

        return $this;
    }

    public function minLength(int $int): self
    {
        $this->minLength = $int;

        return $this;
    }

    private function checkRequire(?string $string): bool
    {
        if ($this->isRequire) {
            return $string !== null && $string !== '';
        }

        return true;
    }

    private function checkContains(?string $string): bool
    {
        if ($this->contains !== null) {
            return str_contains($string, $this->contains);
        }

        return true;
    }

    private function checkMinLength(?string $string): bool
    {
        if ($string != null) {
            return strlen($string) >= $this->minLength;
        }

        return true;
    }

    private function checkCustom(?string $string): bool
    {
        foreach ($this->activateCustomValidation as $validation) {
            $result = $validation->isValid($string);
            if ($result === false) {
                return false;
            }
        }

        return true;
    }

    public function test($name, $value): self
    {
        $customValidator = $this->customValidation[$name] ?? new NonExistentCustomValidator();
        $customValidator->test($value);

        $this->activateCustomValidation[] = $customValidator;

        return $this;
    }
}
