<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class Image extends Model
{
    public $nameAttributeSet = false;

    public function getNameAttribute($value)
    {
        if ($this->nameAttributeSet) {
            return $value;
        } else {

            $image = Image::where('name', $value)->first();
            $assetPath = null;
            $filePath = null;
            if ($image) {
                $assetPath = asset($image['path'] . '/' . $value);
                $filePath=base_path() . '/storage/app/public/albums/' . $image->album_id . '/' . $value;
            }
            if (!File::exists($filePath)) $assetPath = asset('admin/img/404.jpg');
            return $assetPath;
        }
    }

    public function album()
    {
        return $this->belongsTo('App\Album');
    }
}
