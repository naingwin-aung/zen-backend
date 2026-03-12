<?php

use Illuminate\Support\Facades\Storage;

if (!function_exists('storeImage')) {
    function storeImage(string $folderName, $image, $path = 'public')
    {
        return Storage::disk('public')->put($folderName, $image, $path);
    }
}