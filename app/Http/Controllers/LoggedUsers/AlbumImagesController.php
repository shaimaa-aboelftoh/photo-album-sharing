<?php

namespace App\Http\Controllers\LoggedUsers;

use App\Album;
use App\Image;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class AlbumImagesController extends Controller
{
    const VIEW_PATH = 'logged-users.albums.';

    /**
     * @param Album $album
     * @param $images
     */
    public function storeImages(Album $album, $images)
    {
        foreach ($images as $image) {
            $file = $image;
            $extension = $file->extension();
            $newFileName = time() . '_' . $album->id . '_' . md5((string)mt_rand(1, 1000000)) . '.' . $extension;
            $file->storeAs('public/albums/' . $album->id, $newFileName);

            $image = new Image();
            $image->album_id = $album->id;
            $image->name = $newFileName;
            $image->path = 'storage/albums/' . $album->id;
            $image->size = $file->getSize();
            $image->extension = $extension;
            $image->save();
        }
    }

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
        $album->typeAttributeSet = true;
        $data = view(self::VIEW_PATH . 'ajax.get-album-images-ajax')->with([
            'album' => $album
        ])->render();
        return json_response($data);
    }
}
