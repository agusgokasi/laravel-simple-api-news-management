<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

trait Uploader{
    
    public function uploader($upload_file, $dir = 'files', $disk = 'public')
    {
        $file = Storage::disk($disk)->put($dir, $upload_file);
        // $fullPath = Storage::disk($disk)->url($file);

        return $file;
    }

    public function uploaded_image($image, $disk = 'public')
    {
        if(Storage::disk($disk)->exists($image))
        {
            return asset(Storage::url($image));
        }

        return asset($image);
    }
}