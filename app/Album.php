<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class Album extends Model
{
    public $typeAttributeSet = false;
    public $coverAttributeSet = false;

    public function getTypeAttribute($value)
    {
        if ($this->typeAttributeSet) {
            return $value;
        } else {
            return ucfirst($value);
        }
    }

    public function getCoverAttribute($value)
    {
        if ($this->coverAttributeSet) {
            return $value;
        } else {
            $album = Album::where('cover', $value)->where('cover', '!=', null)->first();
            $assetPath = null;
            $filePath = null;
            if ($album) {
                $assetPath = asset('storage/albums/' . $album['id'] . '/' . $value);
                $filePath=base_path() . '/storage/app/public/albums/' . $album['id'] . '/' . $value;
            }
            if (!File::exists($filePath)) $assetPath = asset('admin/img/album-cover.jpg');
            return $assetPath;
        }
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function image()
    {
        return $this->hasMany('App\Image')->orderByDesc('id');
    }
}
