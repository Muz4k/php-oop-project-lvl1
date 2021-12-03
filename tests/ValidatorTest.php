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

    public function testRequired(): void
    {
        $v = new Validator();

        $schema = $v->string();
        $schema2 = $v->string();

        $this->assertTrue($schema->isValid(''));
        $this->assertTrue($schema->isValid(null));
        $this->assertTrue($schema->isValid('what does the fox say'));

        $schema->required();

        $this->assertTrue($schema2->isValid(''));
        $this->assertTrue($schema->isValid('hexlet'));
        $this->assertFalse($schema->isValid(null));
        $this->assertFalse($schema->isValid(''));
    }

    public function testContains(): void
    {
        $v = new Validator();

        $schema = $v->string();
        $res1 = $schema->contains('what')->isValid('what does the fox say');
        $res2 = $schema->contains('whatthe')->isValid('what does the fox say');

        $this->assertTrue($res1);
        $this->assertFalse($res2);
    }

    public function testMinLength(): void
    {
        $v = new Validator();

        $res = $v->string()->minLength(10)->minLength(5)->isValid('Hexlet');
        $this->assertTrue($res);
    }
}
