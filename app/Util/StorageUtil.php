<?php

namespace App\Util;

use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Image;
use Intervention\Image\ImageManager;

class StorageUtil
{
    static function uploadBookImage($file){
        $nama_file = time()."_".$file->getClientOriginalName();
        $tujuan_upload = 'images';
        $file->storeAs('public/'.$tujuan_upload, $nama_file);

        $image_manager = new ImageManager(Driver::class);
        $image = $image_manager->read('storage/'.$tujuan_upload.'/'.$nama_file);
        $image->cover(240, 320);
        $image->save('storage/'.$tujuan_upload.'/'.$nama_file);

        return '/storage/'.$tujuan_upload.'/'.$nama_file;
    }
}
