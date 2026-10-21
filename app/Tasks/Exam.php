<?php

declare(strict_types=1);

namespace App\Tasks;

class Exam extends TestTrial
{
    public function getPassingScore(): int
    {
        return parent::getPassingScore() + 20;
    }
}
