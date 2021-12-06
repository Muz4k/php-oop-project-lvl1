<?php

namespace Hexlet\Validator\Tests;

use PHPUnit\Framework\TestCase;
use Hexlet\Validator\Validator;

class ValidatorTest extends TestCase
{
    public function testGetSchema(): void
    {
        $v = new Validator();

        $schema = $v->string();
        $schema2 = $v->string();
        $this->assertNotSame($schema, $schema2);
    }
}
