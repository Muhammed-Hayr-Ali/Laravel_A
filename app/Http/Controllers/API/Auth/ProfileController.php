<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\ImageUploader;
use App\Traits\BaseResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    use BaseResponse;
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

        return $this->sendResponses('Success', 'The user file has been retrieved!', $success);
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $userId = $user->id;
        $request->validate(
            [
                'phone_number' => 'required|unique:users,phone_number,' . $userId . ',id|max:255',
            ],
            [
                'phone_number.unique' => 'This Phone is already in use.',
            ],
        );

        $input = $request->all();
        $user->name = $input['name'];
        $user->phone_number = $input['phone_number'];
        $user->status = $input['status'];
        $user->phone_number = $input['phone_number'];
        $user->gender = $input['gender'] ?? $user->gender;
        $user->date_birth = $input['date_birth'];

        if ($request->hasFile('profile')) {
            $user->profile = $this->saveImage($request, 'profile', 'profile') ?? $user->profile;
        }
        /** @var \App\Models\User $user **/
        $user->save();
        $user = Auth::user();
        $success['profile'] = $user;
        return $this->sendResponses('Success', 'Profile has been updated', $success);
    }

    public function checkHasImage(Request $request)
    {
        $path = $request->path;
        if (Storage::disk('user/profile')->exists($path)) {
            return $this->sendResponses('Success', 'has file');
        }
        return $this->sendError('error', 'No file ');
    }
}
