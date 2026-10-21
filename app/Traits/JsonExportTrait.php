<?php

declare(strict_types=1);

namespace App\Traits;

trait JsonExportTrait
{
    public function exportToJson(): string
    {
        return (string) json_encode(get_object_vars($this), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
}
