<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

Auth::routes(['request' => false, 'email' => false, 'reset' => false]);

Route::get('/', 'HomeController@getHomePage')->name('home');
Route::get('/album/{album}', 'HomeController@getAlbumImages')->name('exploreAlbum');

Route::group(['middleware' => 'guest'], function () {
    Route::post('/login', 'CustomAuthController@postLoginAjax')->name('loginAjax');
    Route::post('/register', 'CustomAuthController@postRegisterAjax')->name('registerAjax');
});

Route::group(['middleware' => 'guest', 'namespace' => 'Auth'], function () {
    Route::post('/login', 'CustomAuthController@postLoginAjax')->name('loginAjax');
    Route::post('/register', 'CustomAuthController@postRegisterAjax')->name('registerAjax');
});

Route::group(['middleware' => 'auth'], function () {

    Route::group(['namespace' => 'LoggedUsers'], function () {

        Route::group(['as' => 'profile.', 'prefix' => 'profile'], function () {
            Route::get('/', 'ProfileController@getUpdateProfile')->name('edit');
            Route::post('/', 'ProfileController@postUpdateProfile')->name('update');
        });

        Route::group(['as' => 'album.', 'prefix' => 'my-albums'], function () {
            Route::get('/', 'AlbumsController@getAllAlbums')->name('all');
            Route::get('/create', 'AlbumsController@getCreateAlbum')->name('create');
            Route::post('/create', 'AlbumsController@postCreateAlbum')->name('store');
            Route::get('/{album}/show', 'AlbumsController@getShowAlbum')->name('show');
            Route::get('/{album}/update', 'AlbumsController@getUpdateAlbum')->name('edit');
            Route::post('/{album}/update', 'AlbumsController@postUpdateAlbum')->name('update');
            Route::post('/{album}/delete', 'AlbumsController@postDeleteAlbum')->name('delete');
            Route::get('/ajax', 'AlbumsController@getAlbumsAjax')->name('ajax');

            Route::group(['as' => 'image.', 'prefix' => 'images'], function () {
                Route::post('/{image}/delete', 'AlbumImagesController@postDeleteAlbumImage')->name('delete');
                Route::get('/{album}/ajax', 'AlbumImagesController@getAlbumImagesAjax')->name('ajax');
            });

        });
    });


    // Routes for dashboard
    Route::group(['as' => 'dashboard.', 'namespace' => 'Admin', 'prefix' => 'dashboard'], function () {

        Route::get('/', 'DashboardController@getDashboard')->name('index')->middleware('permission:show-dashboard');

        // roles
        Route::group(['as' => 'role.', 'prefix' => 'roles'], function () {
            Route::get('/', 'RolesController@getAllRoles')->name('all')->middleware('permission:all-roles');
            Route::get('/create', 'RolesController@getCreateRole')->name('create')->middleware('permission:create-role');
            Route::post('/create', 'RolesController@postCreateRole')->name('store')->middleware('permission:create-role');
            Route::get('{role}/show', 'RolesController@getShowRole')->name('show')->middleware('permission:show-role');
            Route::get('{role}/update', 'RolesController@getUpdateRole')->name('edit')->middleware('permission:edit-role');
            Route::post('{role}/update', 'RolesController@postUpdateRole')->name('update')->middleware('permission:edit-role');
            Route::post('{role}/delete', 'RolesController@postDeleteRole')->name('delete')->middleware('permission:delete-role');
            Route::get('/ajax', 'RolesController@getRolesAjax')->name('ajax')->middleware('permission:all-roles');
        });

        // Users
        Route::group(['as' => 'user.', 'prefix' => 'system-users'], function () {
            Route::get('/admins', 'UsersController@getAllAdmins')->name('allAdmins')->middleware('permission:all-admins');
            Route::get('/users', 'UsersController@getAllUsers')->name('allUsers')->middleware('permission:all-users');
            Route::get('/create', 'UsersController@getCreateUser')->name('create')->middleware('permission:create-user');
            Route::post('/create', 'UsersController@postCreateUser')->name('store')->middleware('permission:create-user');
            Route::get('/{parentPrefix}/{user}/show', 'UsersController@getShowUser')->name('show')->middleware('permission:show-user');
            Route::get('/{parentPrefix}/{user}/update', 'UsersController@getUpdateUser')->name('edit')->middleware('permission:edit-user');
            Route::post('{user}/update', 'UsersController@postUpdateUser')->name('update')->middleware('permission:edit-user');
            Route::post('{user}/delete', 'UsersController@postDeleteUser')->name('delete')->middleware('permission:delete-user');

            Route::get('/admins-ajax', 'UsersController@getAdminsAjax')->name('adminsAjax')->middleware('permission:all-admins');
            Route::get('/users-ajax', 'UsersController@getUsersAjax')->name('usersAjax')->middleware('permission:all-users');
        });


        // Albums
        Route::group(['as' => 'album.', 'prefix' => 'user-albums'], function () {
            Route::get('/{parentPrefix}/{user}/albums', 'AlbumsController@getUserAlbums')->name('all')->middleware('permission:user-albums');
            Route::get('/{parentPrefix}/{user}/{album}/show', 'AlbumsController@getShowUserAlbum')->name('show')->middleware('permission:show-user-album');
            Route::post('/{album}/delete', 'AlbumsController@postDeleteAlbum')->name('delete')->middleware('permission:delete-user-album');
            Route::get('/{user}/ajax', 'AlbumsController@getAlbumsAjax')->name('ajax')->middleware('permission:user-albums');

            Route::group(['as' => 'image.', 'prefix' => 'images'], function () {
                Route::post('/{image}/delete', 'AlbumImagesController@postDeleteAlbumImage')->name('delete')->middleware('permission:delete-user-image');
                Route::get('/{album}/ajax', 'AlbumImagesController@getAlbumImagesAjax')->name('ajax')->middleware('permission:show-user-album');
            });
        });
    });
});
