<?php


namespace Code;


class ReverseWord
{
    public function handle(string $string): string
    {
        $trimmedSentence = trim($string);
        $words = explode(' ', $trimmedSentence);

        $result = [];
        foreach ($words as $key => $word) {
            if ($this->isEvenNumber($key + 1)) {
                $word = strrev($word);
            }
            $result[] = $word;
        }

        return implode(' ', $result);
    }

    private function isEvenNumber(int $number):bool
    {
        return $number % 2 === 0;
    }
}