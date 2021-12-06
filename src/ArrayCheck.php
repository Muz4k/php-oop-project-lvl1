<?php

namespace Hexlet\Validator;

class ArrayCheck
{
    private bool $isRequired = false;
    private bool $hasCountCheck = false;
    private int $countCheck;

    public function isValid(?array $array)
    {
        return $this->checkRequired($array) && $this->checkSizeOf($array);
    }

    public function required(): self
    {
        $this->isRequired = true;
        return $this;
    }

    public function sizeOf(int $int): self
    {
        $this->hasCountCheck = true;
        $this->countCheck = $int;

        return $this;
    }

    private function checkRequired(?array $array): bool
    {
        if ($this->isRequired) {
            return is_array($array);
        }

        return true;
    }

    private function checkSizeOf(?array $array): bool
    {
        if ($this->hasCountCheck) {
            return count($array) === $this->countCheck;
        }

        return true;
    }
}