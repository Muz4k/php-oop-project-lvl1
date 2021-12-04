<?php

namespace Hexlet\Validator;

class Validator
{
    public function string(): StringCheck
    {
        return new StringCheck();
    }

    public function number(): NumberCheck
    {
        return new NumberCheck();
    }
}
