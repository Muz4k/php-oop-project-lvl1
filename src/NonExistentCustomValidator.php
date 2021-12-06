<?php

namespace Hexlet\Validator;

use Exception;

class NonExistentCustomValidator
{
    public function test($value): Exception
    {
        throw new Exception('Validator not found!');
    }
}
