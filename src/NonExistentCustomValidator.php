<?php

namespace Hexlet\Validator;

use Exception;

class NonExistentCustomValidator
{
    public function test($value)
    {
        throw new Exception('Validator not found!');
    }
}
