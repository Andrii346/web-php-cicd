<?php

declare(strict_types=1);

namespace App\Services;

use App\Interfaces\LoggerInterface;

class FileLogger implements LoggerInterface
{
    public function log(string $message): void
    {
        echo '[FILE LOG] '.date('Y-m-d H:i:s').' -> Записано в файл: '.$message.PHP_EOL;
    }
}
