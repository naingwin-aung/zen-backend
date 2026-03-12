<?php

use Illuminate\Support\Facades\Storage;

if (!function_exists('storeImage')) {
    function storeImage(string $folderName, $image, $path = 'public')
    {
        return Storage::put($folderName, $image, $path);
    }
}