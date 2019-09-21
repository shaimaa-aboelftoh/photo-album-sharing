<?php

namespace App\Http\Controllers\LoggedUsers;

use App\Album;
use App\Http\Requests\LoggedUsers\CreateAlbumRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AlbumsController extends AlbumImagesController
{
    const VIEW_PATH = 'logged-users.albums.';

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAllAlbums()
    {
        $user = auth()->user();
        $albums = Album::whereUserId($user->id)
            ->select(['id', 'name','type'])
            ->orderByDesc('id')
            ->get();
        return view(self::VIEW_PATH . 'all-albums')->with([
            'pageTitle' => 'Albums',
            'albums' => $albums,
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getCreateAlbum()
    {
        return view(self::VIEW_PATH . 'create-album')->with([
            'pageTitle' => 'Create Album',
        ]);
    }

    /**
     * @param Album $album
     * @param $cover
     * @param bool $update
     */
    public function storeAlbumCoverImage(Album $album, $cover, bool $update = false)
    {
        $album->coverAttributeSet = true;
        if ($update) {
            $filePath = base_path() . '/storage/app/public/albums/' . $album->id . '/' . $album->cover;
            if (File::exists($filePath)) File::delete($filePath);
        }
        $file = $cover;
        $extension = $file->extension();
        $newFileName = time() . '_' . $album->id . '_' . md5((string)mt_rand(1, 1000000)) . '.' . $extension;
        $file->storeAs('public/albums/' . $album->id, $newFileName);
        $album->cover = $newFileName;
        $album->update();
    }

    /**
     * @param CreateAlbumRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postCreateAlbum(CreateAlbumRequest $request)
    {
        $album = new Album();
        $album->user_id = auth()->user()->id;
        $album->name = $request['name'];
        $album->type = $request['type'];
        $album->notes = $request['notes'];
        $album->save();

        if ($request->hasFile('cover')) {
            $this->storeAlbumCoverImage($album, $request['cover']);
        }

        if ($request['images'] != null && $request->hasFile('images')) {
            $this->storeImages($album, $request['images']);
        }

        return json_response(null, 'Album Created successfully !');
    }

    /**
     * @param Album $album
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getShowAlbum(Album $album)
    {
        return view(self::VIEW_PATH . 'show-album')->with([
            'pageTitle' => str_limit($album->name, 60),
            'album' => $album,
        ]);
    }

    /**
     * @param Album $album
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getUpdateAlbum(Album $album)
    {
        $album->typeAttributeSet = true;
        return view(self::VIEW_PATH . 'update-album')->with([
            'pageTitle' => str_limit($album->name, 60),
            'album' => $album,
        ]);
    }

    /**
     * @param CreateAlbumRequest $request
     * @param Album $album
     * @return \Illuminate\Http\JsonResponse
     */
    public function postUpdateAlbum(CreateAlbumRequest $request, Album $album)
    {
        $album->name = $request['name'];
        $album->type = $request['type'];
        $album->notes = $request['notes'];
        $album->update();

        $coverPath = null;
        $imagesRefresh = false;
        if ($request->hasFile('cover')) {
            $this->storeAlbumCoverImage($album, $request['cover'], true);
            $coverPath = asset('storage/albums/' . $album['id'] . '/' . $album['cover']);
        }

        if ($request['images'] != null && $request->hasFile('images')) {
            $this->storeImages($album, $request['images']);
            $imagesRefresh = true;
        }
        return json_response(['coverPath' => $coverPath, 'imagesRefresh' => $imagesRefresh],
            'Album Updated successfully !');
    }

    /**
     * @param Album $album
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function postDeleteAlbum(Album $album)
    {
        $folderPath = base_path() . '/storage/app/public/albums/' . $album['id'];
        if (File::exists($folderPath)) File::deleteDirectory($folderPath);
        $album->delete();
        return json_response(null, 'Album Deleted Successfully !');
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function getAlbumsAjax()
    {
        $user = auth()->user();
        $albums = Album::whereUserId($user->id)
            ->select(['id', 'name','type'])
            ->orderByDesc('id')
            ->get();
        $data = view(self::VIEW_PATH . 'ajax.get-all-albums-ajax')->with([
            'albums' => $albums
        ])->render();
        return json_response($data);
    }
}
