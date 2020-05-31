<?php

namespace App;

use Closure;
use JsonException;

class Memoizator
{
    //Необходимо закешировать переданную функцию
    public function handle(Closure $fn): Closure
    {
        $cache = [];
        return function (...$args) use ($fn, &$cache) {
            $cacheKey = $this->generateHash(...$args);
            if (!array_key_exists($cacheKey, $cache)) {
                $cacheValue = $fn(...$args);
                $cache[$cacheKey] = $cacheValue;
            } else {
                $cacheValue = $cache[$cacheKey];
            }
            return $cacheValue;
        };
    }

    /**
     * @param mixed ...$args
     * @return string
     * @throws JsonException
     */
    private function generateHash(...$args): string
    {
        return json_encode($args, JSON_THROW_ON_ERROR);
    }
}
