<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class StorageHelper
{
    public static function getFiles(string $directory): array
    {
        $files = Storage::allFiles($directory);
        natsort($files);
        return $files;
    }
}
