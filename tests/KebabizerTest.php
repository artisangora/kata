<?php

namespace App\Tests;

use App\Kebabizer;
use PHPUnit\Framework\TestCase;

class KebabizerTest extends TestCase
{
    public function testSimple(): void
    {
        $k = new Kebabizer();

        $this->assertEquals('my-camel-cased-string', $k->handle('myCamelCasedString'));
        $this->assertEquals('my-camel-has-humps', $k->handle('myCamelHas3Humps'));
        $this->assertEquals('my-camel-has-humps', $k->handle('MyCamelHasHumps'));
    }
}
