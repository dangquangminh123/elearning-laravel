<?php

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
if (!function_exists('getFileInfo')) {
    function getFileInfo($url) {
        $path = Storage::disk('public')->path(str_replace('storage', '', $url));
        return [
            'name' => basename($url),
            'size' => File::size($path)
        ];
    }
}
?>