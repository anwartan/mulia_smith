<?php

namespace App\Utils;

use Carbon\Carbon;

class FileUpload{
    public static function upload( $file){
        $now = Carbon::now()->valueOf();
        $name=$now.'-'.$file->getClientOriginalName();
        $file->move(public_path().'/files/', $name);  
        return $name;
    }
}