<?php

namespace App\Http\Controllers\API\Auth;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\ImageUploader;
use App\Traits\BaseValidator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;


class ProfileController extends Controller
{
    use BaseValidator;
    use ImageUploader;

    public function getCurrentUser(Request $request)
    {
        $user = Auth::user();
        if ($request->notification_token != null) {
            $user->notification_token = $request->notification_token;
            /** @var \App\Models\User $user **/
            $user->save();
        }
        $success['profile'] = $user;

        return $this->sendResponses('The user file has been retrieved!', $success);
    }


    public function updateProfile(Request $request)
    {
        $userId = Auth::user()->id;
        $user = User::find($userId);


        $validator = Validator::make(
            $request->all(),
            [
                'phone_number' => 'required|unique:users,phone_number,' . $userId . ',id|max:255'
            ],
            [
                'phone_number.required' => 'Please enter your phone number',
                'phone_number.unique' => 'This phone number is already in use',
            ]
        );
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first(), 400);
        }

        if ($request->hasFile('profile')) {
            $user->profile = $this->saveImage($request, 'profile', 'user/profile') ?? $user->profile;
        }


        $input = $request->all();
        $user->update($input);







        $success['profile'] = $user;
        return $this->sendResponses('Profile has been updated', $success);
    }


    public function logout(Request $request)
    {
        $token = $request->user()->token();
        $token->revoke();
        return $this->sendResponses('User Logout Successfully');
    }
}
