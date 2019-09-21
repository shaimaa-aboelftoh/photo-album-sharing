<?php

namespace App\Http\Controllers\Admin;

use App\Album;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class AlbumsController extends Controller
{
    const VIEW_PATH = 'dashboard.albums.';

    /**
     * @param string $parentPrefix
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getUserAlbums(string $parentPrefix, User $user)
    {
        $albums = Album::whereUserId($user->id)
            ->where('type', 'public')
            ->select(['id', 'name'])
            ->orderByDesc('id')
            ->get();
        return view(self::VIEW_PATH . 'all-albums')->with([
            'pageTitle' => 'Albums of ' . str_limit($user->name, 70),
            'parentPrefix' => $parentPrefix,
            'user' => $user,
            'albums' => $albums,
        ]);
    }

    /**
     * @param string $parentPrefix
     * @param User $user
     * @param Album $album
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getShowUserAlbum(string $parentPrefix, User $user, Album $album)
    {
        if ($album->type == 'private') {
            abort(403);
        }
        return view(self::VIEW_PATH . 'show-album')->with([
            'pageTitle' => 'Images of ' . str_limit($album->name, 60),
            'parentPrefix' => $parentPrefix,
            'user' => $user,
            'album' => $album,
        ]);
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
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function getAlbumsAjax(User $user)
    {
        $albums = Album::whereUserId($user->id)
            ->where('type', 'public')
            ->select(['id', 'name'])
            ->orderByDesc('id')
            ->get();
        $data = view(self::VIEW_PATH . 'ajax.get-all-albums-ajax')->with([
            'albums' => $albums
        ])->render();
        return json_response($data);
    }
}
