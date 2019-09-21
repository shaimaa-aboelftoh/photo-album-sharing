<?php

namespace App\Http\Controllers\Admin;

use App\Album;
use App\Image;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function getDashboard()
    {
        $totalAlbums = Album::count();
        $publicAlbums = Album::whereType('public')->count();
        $privateAlbums = Album::whereType('private')->count();
        $totalImages = Image::count();
        $allUsers = User::count();
        $totalAdmins = User::withRole('admin')->count();
        $totalDefaultUsers = User::withRole('user')->count();

        return view('dashboard.index')->with([
            'totalAlbums' => $totalAlbums,
            'publicAlbums' => $publicAlbums,
            'privateAlbums' => $privateAlbums,
            'totalImages' => $totalImages,
            'allUsers' => $allUsers,
            'totalAdmins' => $totalAdmins,
            'totalDefaultUsers' => $totalDefaultUsers,
        ]);
    }
}
