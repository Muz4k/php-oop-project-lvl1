<?php

namespace Hexlet\Validator;

class ArrayCheck
{
    private bool $isRequired = false;
    private bool $hasCountCheck = false;
    private int $countCheck;
    private bool $hasShapeValidation = false;
    private array $shapeRules;

    public function isValid(?array $array): bool
    {
        return $this->checkRequired($array)
            && $this->checkSizeOf($array)
            && $this->checkShapeRules($array);
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

    public function shape(array $array): self
    {
        $this->hasShapeValidation = true;
        $this->shapeRules = $array;
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
            if (is_array($array)) {
                return count($array) === $this->countCheck;
            }
            return false;
        }

        return true;
    }

    private function checkShapeRules(?array $array): bool
    {
        if ($this->hasShapeValidation) {
            if ($array === null) {
                return false;
            }
            foreach ($array as $key => $value) {
                $rules = $this->shapeRules[$key] ?? null;
                if ($rules) {
                    $isValid = $rules->isValid($value);
                    if ($isValid === false) {
                        return false;
                    }
                }
            }
        }

        return true;
    }
}
