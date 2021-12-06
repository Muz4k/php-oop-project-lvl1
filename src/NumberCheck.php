<?php

namespace Hexlet\Validator;

use Exception;

class NumberCheck
{
    private bool $isRequire = false;
    private bool $isPositive = false;
    private bool $isRange = false;
    private int $minInt;
    private int $maxInt;
    private array $customValidation = [];
    private array $activateCustomValidation = [];

    public function __construct($customValidation = [])
    {
        $this->customValidation = $customValidation;
    }

    public function isValid(?int $int): bool
    {
        return $this->checkRequire($int)
            && $this->checkPositive($int)
            && $this->checkRange($int)
            && $this->checkCustom($int);
    }

    public function required(): self
    {
        $this->isRequire = true;

        return $this;
    }

    public function positive(): self
    {
        $this->isPositive = true;

        return $this;
    }

    public function range(int $min, int $max): self
    {
        $this->isRange = true;
        $this->minInt = $min;
        $this->maxInt = $max;

        return $this;
    }

    private function checkRequire(?int $int): bool
    {
        if ($this->isRequire) {
            return is_int($int);
        }

        return true;
    }

    private function checkPositive(?int $int): bool
    {
        if ($this->isPositive) {
            return $int > 0;
        }

        return true;
    }

    private function checkRange(?int $int): bool
    {
        if ($this->isRange) {
            return $int >= $this->minInt && $int <= $this->maxInt;
        }

        return true;
    }
    private function checkCustom(?int $string): bool
    {
        foreach ($this->activateCustomValidation as $validation) {
            $result = $validation->isValid($string);
            if ($result === false) {
                return false;
            }
        }

        return true;
    }

    public function test($name, $value)
    {
        $customValidator = $this->customValidation[$name] ?? new NonExistentCustomValidator();
        $customValidator->test($value);

        $this->activateCustomValidation[] = $customValidator;

        return $this;
    }
}
