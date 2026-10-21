<?php

declare(strict_types=1);

namespace App\Tasks;

class FinalExam extends Exam
{
    public function getPassingScore(): int
    {
        return parent::getPassingScore() + 15;
    }
}
