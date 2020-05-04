<?php

namespace Tests;

use Code\ReverseWord;
use PHPUnit\Framework\TestCase;


class ReverseWordTest extends TestCase
{
    public function testSimple(): void
    {
        $r = new ReverseWord();

        $this->assertEquals("Did ti work?", $r->handle("Did it work?"));
        $this->assertEquals("I yllaer hope ti works siht time...", $r->handle("I really hope it works this time..."));
        $this->assertEquals("Reverse siht string, !esaelp", $r->handle("Reverse this string, please!"));
        $this->assertEquals("AAA RR", $r->handle(" AAA RR   "));
        $this->assertEquals("", $r->handle("   "));
    }
}