<?php

namespace Hexlet\Validator\Tests;

use Exception;
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

    public function testAddNewValidator(): void
    {
        $v = new Validator();

        $fn = fn($value, $start) => str_starts_with($value, $start);

        $v->addValidator('string', 'startWith', $fn);

        $schema = $v->string()->test('startWith', 'H');
        $this->assertFalse($schema->isValid('exlet'));
        $this->assertTrue($schema->isValid('Hexlet'));

        $fn = fn($value, $min) => $value >= $min;
        $v->addValidator('number', 'min', $fn);

        $schema = $v->number()->test('min', 5);
        $this->assertFalse($schema->isValid(4)); // false
        $this->assertTrue($schema->isValid(6)); // true

        $fn = fn($value, $constrain) => in_array($constrain, $value);
        $v->addValidator('array', 'in_array', $fn);

        $schema = $v->array()->test('in_array', 'test');

        $this->assertTrue($schema->isValid(['test']));
        $this->assertFalse($schema->isValid(['tes2t']));

        $this->expectException(Exception::class);
        $v->addValidator('wrong-name', 'startWith', $fn);
    }
}
