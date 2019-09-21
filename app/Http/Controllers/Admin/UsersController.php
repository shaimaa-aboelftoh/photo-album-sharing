<?php

namespace App\Http\Controllers\Admin;

use App\Entrust\Role;
use App\Http\Requests\Dashboard\CreateUserRequest;
use App\Http\Requests\Dashboard\UpdateUserRequest;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class UsersController extends Controller
{
    const VIEW_PATH = 'dashboard.users.';

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAllAdmins()
    {
        $users = User::whereHas('roles', function ($q) {
            $q->where('name', '!=', 'user');
        })->orderByDesc('id')->get();

        $parentPrefix = 'admins';
        $breadcrumb = 'allAdmins';
        return view(self::VIEW_PATH . 'all-users')->with([
            'pageTitle' => 'Admins Management',
            'users' => $users,
            'parentPrefix' => $parentPrefix,
            'breadcrumb' => $breadcrumb,
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAllUsers()
    {
        $users = User::whereHas('roles', function ($q) {
            $q->where('name', '=', 'user');
        })->orderByDesc('id')->get();

        $parentPrefix = 'users';
        $breadcrumb = 'allUsers';
        return view(self::VIEW_PATH . 'all-users')->with([
            'pageTitle' => 'Users Management',
            'users' => $users,
            'parentPrefix' => $parentPrefix,
            'breadcrumb' => $breadcrumb,
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getCreateUser()
    {
        $roles = Role::all();
        return view(self::VIEW_PATH . 'create-user')->with([
            'pageTitle' => 'Create User',
            'roles' => $roles
        ]);
    }

    /**
     * @param CreateUserRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postCreateUser(CreateUserRequest $request)
    {
        $request['password'] = bcrypt($request['password']);
        $user = User::create($request->all());
        $user->roles()->attach($request['role_ids']);
        return json_response(null, 'User Created successfully !');
    }

    /**
     * @param string $parentPrefix
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getShowUser(string $parentPrefix, User $user)
    {
        return view(self::VIEW_PATH . 'show-user')->with([
            'pageTitle' => str_limit($user->name, 60),
            'parentPrefix' => $parentPrefix,
            'user' => $user,
        ]);
    }

    /**
     * @param string $parentPrefix
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getUpdateUser(string $parentPrefix, User $user)
    {
        if ($user->id == 1 && auth()->user()->id != 1) {
            abort(403);
        }
        $userRoleIds = $user->roles()->pluck('id')->toArray();
        $roles = Role::all();
        return view(self::VIEW_PATH . 'update-user')->with([
            'pageTitle' => str_limit($user->name, 60),
            'user' => $user,
            'userRoleIds' => $userRoleIds,
            'roles' => $roles,
            'parentPrefix' => $parentPrefix,
        ]);
    }

    public function postUpdateUser(UpdateUserRequest $request, User $user)
    {
        $request['password'] ? $request['password'] = bcrypt($request['password']) : $request['password'] = $user->password;
        $user->update($request->all());

        $user->roles()->detach();
        $user->roles()->attach($request['role_ids']);
        return json_response(null, 'User Updated successfully !');
    }

    /**
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function postDeleteUser(User $user)
    {
        if ($user->id == 1) {
            abort(403);
        }
        foreach ($user->album as $album) {
            $folderPath = base_path() . '/storage/app/public/albums/' . $album['id'];
            if (File::exists($folderPath)) File::deleteDirectory($folderPath);
        }
        $user->delete();
        return json_response(null, 'User Deleted successfully !');
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function getAdminsAjax()
    {
        $users = User::whereHas('roles', function ($q) {
            $q->where('name', '!=', 'user');
        })->orderByDesc('id')->get();
        $parentPrefix = 'admins';
        $data = view(self::VIEW_PATH . 'ajax.get-all-users-ajax')->with([
            'users' => $users,
            'parentPrefix' => $parentPrefix
        ])->render();
        return json_response($data);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function getUsersAjax()
    {
        $users = User::whereHas('roles', function ($q) {
            $q->where('name', '=', 'user');
        })->orderByDesc('id')->get();
        $parentPrefix = 'users';
        $data = view(self::VIEW_PATH . 'ajax.get-all-users-ajax')->with([
            'users' => $users,
            'parentPrefix' => $parentPrefix
        ])->render();
        return json_response($data);
    }
}
