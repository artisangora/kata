<?php

namespace App\Tests;

use App\Memoizator;
use Closure;
use PHPUnit\Framework\TestCase;

class MemoizatorTest extends TestCase
{
    public function testOriginalFunction(): void
    {
        $expectedValue = '42';
        $originalFunction = Closure::fromCallable([$this, 'echoAndReturnValue']);

        $result1 = $originalFunction($expectedValue);
        $result2 = $originalFunction($expectedValue);

        $expectedOutput = $expectedValue . $expectedValue;
        $this->assertEquals($expectedOutput, $this->getActualOutputForAssertion());
        $this->assertEquals($expectedValue, $result1);
        $this->assertEquals($expectedValue, $result2);
    }

    public function testMemoizedFunction(): void
    {
        $expectedValue = '42';
        $originalFunction = Closure::fromCallable([$this, 'echoAndReturnValue']);
        $m = new Memoizator();
        $memoizedFunction = $m->handle($originalFunction);

        $result1 = $memoizedFunction($expectedValue);
        $result2 = $memoizedFunction($expectedValue);
        $result3 = $memoizedFunction($expectedValue);

        $this->assertEquals($expectedValue, $this->getActualOutputForAssertion());
        $this->assertEquals($expectedValue, $result1);
        $this->assertEquals($expectedValue, $result2);
        $this->assertEquals($expectedValue, $result3);
    }

    public function testDifferentMemoizedValues(): void
    {
        $expectedValue1 = '42';
        $expectedValue2 = '89';
        $originalFunction = Closure::fromCallable([$this, 'echoAndReturnValue']);
        $m = new Memoizator();
        $memoizedFunction = $m->handle($originalFunction);

        $result1 = $memoizedFunction($expectedValue1);
        $result2 = $memoizedFunction($expectedValue1);
        $result3 = $memoizedFunction($expectedValue2);
        $result4 = $memoizedFunction($expectedValue2);

        $expectedOutput = $expectedValue1 . $expectedValue2;
        $this->assertEquals($expectedOutput, $this->getActualOutputForAssertion());
        $this->assertEquals($expectedValue1, $result1);
        $this->assertEquals($expectedValue1, $result2);
        $this->assertEquals($expectedValue2, $result3);
        $this->assertEquals($expectedValue2, $result4);
    }

    public function testMemorizeTwoDifferentFunctions(): void
    {
        $expectedValue1 = 42;
        $expectedValue2 = 21;
        $originalFunction1 = static function (...$args) {
            $result = array_sum($args);
            echo $result;
            return $result;
        };
        $originalFunction2 = static function (...$args) {
            $result = array_sum($args) / count($args);
            echo $result;
            return $result;
        };

        $m = new Memoizator();
        $memoizedFunction1 = $m->handle($originalFunction1);
        $memoizedFunction2 = $m->handle($originalFunction2);

        $result1 = $memoizedFunction1(21, 21);
        $result2 = $memoizedFunction1(21, 21);
        $result3 = $memoizedFunction2(21, 21);
        $result4 = $memoizedFunction2(21, 21);

        $expectedOutput = $expectedValue1 . $expectedValue2;
        $this->assertEquals($expectedOutput, $this->getActualOutputForAssertion());
        $this->assertEquals($expectedValue1, $result1);
        $this->assertEquals($expectedValue1, $result2);
        $this->assertEquals($expectedValue2, $result3);
        $this->assertEquals($expectedValue2, $result4);
    }

    private function echoAndReturnValue(string $expectedValue): string
    {
        echo $expectedValue;
        return $expectedValue;
    }
}
