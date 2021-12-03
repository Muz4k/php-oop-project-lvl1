<?php

namespace Hexlet\Validator;

class Validator
{
    public function string(): StringCheck
    {
        return new StringCheck();
    }
}
