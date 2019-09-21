<?php

namespace App\Http\Controllers;

use App\Album;
use App\Image;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getHomePage()
    {
        $albums = Album::where('type', 'public')
            ->orderByDesc('id')
            ->paginate(9);
        return view('home', compact('albums'));
    }

    public function getAlbumImages(Album $album)
    {
        if ($album->type == 'private') {
            abort(403);
        }
        $images=Image::whereAlbumId($album->id)
        ->orderByDesc('id')
        ->paginate(12);
        return view('album-images', compact('album','images'));
    }


}
