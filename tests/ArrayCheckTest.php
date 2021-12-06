<?php

namespace Hexlet\Validator\Tests;

use Hexlet\Validator\Validator;
use PHPUnit\Framework\TestCase;

class ArrayCheckTest extends TestCase
{
    public function testRequired(): void
    {
        $v = new Validator();

        $schema = $v->array();

        $this->assertTrue($schema->isValid(null));

        $schema = $schema->required();

        $this->assertTrue($schema->isValid([]));
        $this->assertFalse($schema->isValid(null));
        $this->assertTrue($schema->isValid(['hexlet']));
    }

    public function testSizeOf(): void
    {
        $v = new Validator();

        $schema = $v->array();

        $schema->sizeof(2);

        $this->assertFalse($schema->isValid(['hexlet']));
        $this->assertTrue($schema->isValid(['hexlet', 'code-basics']));
    }

    public function testShapeValidation(): void
    {
        $v = new Validator();

        $schema = $v->array();

        $schema->shape([
            'name' => $v->string()->required(),
            'age' => $v->number()->positive(),
        ]);

        $this->assertTrue($schema->isValid(['name' => 'kolya', 'age' => 100]));
        $this->assertTrue($schema->isValid(['name' => 'maya', 'age' => null]));
        $this->assertFalse($schema->isValid(['name' => '', 'age' => null]));
        $this->assertFalse($schema->isValid(['name' => 'ada', 'age' => -5]));
    }
}
