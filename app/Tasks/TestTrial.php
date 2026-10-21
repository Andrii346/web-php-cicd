<?php

declare(strict_types=1);

namespace App\Tasks;

class TestTrial extends Trial
{
    public function getPassingScore(): int
    {
        return 50;
    }
}
