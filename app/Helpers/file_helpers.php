<?php

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
function saveImage($path, $file)
{
    if (!($file instanceof UploadedFile)) {
        $tempFile = tempnam(sys_get_temp_dir(), 'temp_img');
        file_put_contents($tempFile, $file);

        $file = new UploadedFile($tempFile, basename($file));
    }
    $full_stored_image_path = Storage::disk('public')->putFile($path,$file);
    return $full_stored_image_path;
}

function editImage($path, $file, $oldImage)
{
    deleteImage($oldImage);
    return saveImage($path, $file);
}
function moveFile($from, $to)
{
    if (is_file_exists($from)) {
            return Storage::disk('public')->move($from, $to);
    }
}

function deleteImage($oldImage)
{
    if ($oldImage != null) {

        $exists = Storage::disk('public')->exists($oldImage);
        if ($exists) {
            Storage::disk('public')->delete($oldImage);
            return true;
        }
    }
}

/**
 * get image url if exists. else return default placeholder image
 */
function getImageUrl($image)
{
    if (is_null($image)) {
        return asset('assets/common/product-placeholder.webp');
    }
    $exists = Storage::disk('public')->exists($image);
    if ($exists) {
        return Storage::url($image);
    } else {
        return asset('assets/common/product-placeholder.webp');
    }
}

if (!function_exists('is_file_exists')) {
    function is_file_exists($path, $disk = 'public') : bool
    {
        return Storage::disk($disk)->exists($path);
    }
}

/**
 * Download File From Storage.
 */
function downloadFile($path)
{
    $path = str_replace('storage/', '', $path);
    $exists = Storage::disk('public')->exists($path);
    if ($exists) {
        return Storage::disk('public')->download($path);
    }
}
