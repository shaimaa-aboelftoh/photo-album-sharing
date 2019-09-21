<?php

namespace App\Http\Controllers\LoggedUsers;

use App\Http\Requests\LoggedUsers\UpdateProfileRequest;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getUpdateProfile()
    {
        $user = auth()->user();
        return view('logged-users.profile.profile')->with([
            'pageTitle' => $user->name . ' Profile',
            'user' => $user,
        ]);
    }

    /**
     * @param UpdateProfileRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postUpdateProfile(UpdateProfileRequest $request)
    {
        $user = auth()->user();
        $user->name = $request['name'];
        $user->email = $request['email'];
        if ($request['password'] != null) {
            $user->password = bcrypt($request['password']);
        }
        $user->update();
        return json_response(null, 'Your profile data has been updated successfully !');
    }
}
