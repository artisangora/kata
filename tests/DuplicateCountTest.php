<?php

namespace Tests;

use Code\DuplicateCount;
use PHPUnit\Framework\TestCase;


class DuplicateCountTest extends TestCase
{
    public function testFixedTests(): void
    {
        $dc = new DuplicateCount();

        $this->assertEquals(0, $dc->handle(''));
        $this->assertEquals(0, $dc->handle('abcde'));
        $this->assertEquals(2, $dc->handle('aabbcde'));
        $this->assertEquals(2, $dc->handle('aabBcde'), 'should ignore case');
        $this->assertEquals(1, $dc->handle('Indivisibility'));
        $this->assertEquals(2, $dc->handle('Indivisibilities'), 'characters may not be adjacent');
    }
}