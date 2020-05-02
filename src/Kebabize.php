<?php


namespace Code;

class Kebabize
{
    public function handle(string $string): string
    {
        return strtolower(preg_replace(['/[^a-zA-Z]/', '/([A-Z])/', '/^-/'], ['', '-$1', ''], $string));
    }
}