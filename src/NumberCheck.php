<?php

namespace Hexlet\Validator;

class NumberCheck
{
    private bool $isRequire = false;
    private bool $isPositive = false;
    private bool $isRange = false;
    private int $minInt;
    private int $maxInt;

    public function isValid(?int $int): bool
    {
        return $this->checkRequire($int)
            && $this->checkPositive($int)
            && $this->checkRange($int);
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
}
