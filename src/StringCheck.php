<?php

namespace Hexlet\Validator;

class StringCheck
{
    private bool $isRequire = false;
    private int $minLength = 0;
    private string $contains = '';

    public function isValid(?string $string): bool
    {
        return $this->checkRequire($string)
            && $this->checkContains($string)
            && $this->checkMinLength($string);
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
            return !empty($string);
        }

        return true;
    }

    private function checkContains(?string $string): bool
    {
        if ($this->contains) {
            return str_contains($string, $this->contains);
        }

        return true;
    }

    private function checkMinLength(?string $string): bool
    {
        if ($string) {
            return strlen($string) >= $this->minLength;
        }

        return true;
    }
}
