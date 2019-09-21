<?php

namespace App\Http\Controllers\Admin;

use App\Album;
use App\Image;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class AlbumImagesController extends Controller
{
    const VIEW_PATH = 'dashboard.albums.';

    /**
     * @param Image $image
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function postDeleteAlbumImage(Image $image)
    {
        $image->nameAttributeSet = true;
        $filePath = base_path() . '/storage/app/public/albums/' . $image['album_id'] . '/' . $image['name'];
        if (File::exists($filePath)) File::delete($filePath);
        $image->delete();
        return json_response(null, 'Image Deleted Successfully !');
    }

    /**
     * @param Album $album
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function getAlbumImagesAjax(Album $album)
    {
        $data = view(self::VIEW_PATH . 'ajax.get-album-images-ajax')->with([
            'album' => $album,
        ])->render();
        return json_response($data);
    }
}
