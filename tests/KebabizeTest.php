<?php

namespace Tests;

use Code\Kebabize;
use PHPUnit\Framework\TestCase;


class KebabizeTest extends TestCase
{
    public function testSimple(): void
    {
        $k = new Kebabize();

        $this->assertEquals('my-camel-cased-string', $k->handle('myCamelCasedString'));
        $this->assertEquals('my-camel-has-humps', $k->handle('myCamelHas3Humps'));
        $this->assertEquals('my-camel-has-humps', $k->handle('MyCamelHasHumps'));
    }
}