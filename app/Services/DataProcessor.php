<?php

declare(strict_types=1);

namespace App\Services;

class DataProcessor
{
    /**
     * Задача 1 (Таблиця 3.2, №2):
     * Перетворити цілочисловий масив, вставивши після кожного додатного елемента нульовий елемент.
     *
     * @param int[] $numbers
     * @return int[]
     */
    public function insertZeroAfterPositives(array $numbers): array
    {
        $result = [];

        foreach ($numbers as $number) {
            $result[] = $number;
            if ($number > 0) {
                $result[] = 0;
            }
        }

        return $result;
    }

    /**
     * Задача 2 (Таблиця 3.3, №6):
     * Знайти і порахувати кількість слів у рядку, які починаються із приголосної букви.
     */
    public function countWordsStartingWithConsonant(string $text): int
    {
        $words = preg_split('/\s+/u', trim($text), -1, PREG_SPLIT_NO_EMPTY);
        if (!$words) {
            return 0;
        }

        
        $consonantsPattern = '/^[бвгґджзклмнпрстфхцчшщbcdfghjklmnpqrstvwxyz]/ui';
        $count = 0;

        foreach ($words as $word) {
            if (preg_match($consonantsPattern, $word)) {
                $count++;
            }
        }

        return $count;
    }

    /**
     * Задача 3 (Таблиця 3.4, №1):
     * Дано рядок, який містить числа, розділені пробілами. Знайти максимальне число.
     */
    public function findMaxNumberInString(string $numbersString): float
    {
        
        $items = preg_split('/\s+/', trim($numbersString), -1, PREG_SPLIT_NO_EMPTY);
        if (!$items) {
            return 0.0;
        }

        
        $numericValues = array_map('floatval', $items);

        return max($numericValues);
    }
}