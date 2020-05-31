<?php

namespace App;

use Closure;
use JsonException;

class Memoizator
{
    /**
     * @see https://ru.wikipedia.org/wiki/%D0%9C%D0%B5%D0%BC%D0%BE%D0%B8%D0%B7%D0%B0%D1%86%D0%B8%D1%8F
     * @param Closure $fn
     * @return Closure
     */
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
