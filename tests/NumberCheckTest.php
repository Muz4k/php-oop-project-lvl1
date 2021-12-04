<?php

namespace Hexlet\Validator\Tests;

use Hexlet\Validator\Validator;
use PHPUnit\Framework\TestCase;

class NumberCheckTest extends TestCase
{
    public function testRequired()
    {
        $v = new Validator();

        $schema = $v->number();

        $this->assertTrue($schema->isValid(null));

        $schema->required();

        $this->assertFalse($schema->isValid(null));
        $this->assertTrue($schema->isValid(7));
    }

    public function testPositive()
    {
        $v = new Validator();

        $schema = $v->number();

        $this->assertTrue($schema->positive()->isValid(10));
    }

    public function testRange()
    {
        $v = new Validator();

        $schema = $v->number();
        $schema->positive();
        $schema->range(-5, 5);

        $this->assertFalse($schema->isValid(-3));
        $this->assertTrue($schema->isValid(5));
    }
}