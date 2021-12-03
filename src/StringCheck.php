<?php

namespace Hexlet\Validator;

class StringCheck
{
    private bool $isRequire = false;
    private int $minLength = 0;
    private string $contains = '';

    public function isValid(?string $string): bool
    {
        return $this->checkRequire($string) && $this->checkContains($string);
    }

    public function required()
    {
        $this->isRequire = true;
    }

    public function contains(string $string)
    {
        $this->contains = $string;

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
}