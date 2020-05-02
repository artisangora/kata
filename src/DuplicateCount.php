<?php

namespace Code;

class DuplicateCount
{
    public function handle($text): int
    {
        $lettersCounter = [];
        $lowerCaseText = strtolower($text);
        foreach (str_split($lowerCaseText) as $letter) {
            if (!isset($lettersCounter[$letter])) {
                $lettersCounter[$letter] = 0;
            }
            $lettersCounter[$letter]++;
        }

        $moreThanOneDuplicate = array_filter($lettersCounter, function ($count) {
            return $count > 1;
        });
        return count($moreThanOneDuplicate);
    }
}