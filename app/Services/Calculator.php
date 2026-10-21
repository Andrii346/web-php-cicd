<?php

namespace App\Services;

class Calculator
{
    public function add($x, $y)
    {
        return $x + $y;
    }

    public function subtract($x, $y)
    {
        return $x - $y;
    }

    public function multiply($x, $y)
    {
        return $x * $y;
    }

    public function division($x, $y)
    {
        if($y != 0){
            return $x / $y;
        }
    }
}
