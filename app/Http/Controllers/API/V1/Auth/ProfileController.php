<?php

namespace App\Http\Controllers\API\V1\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Traits\ImageUploader;

class ProfileController extends Controller
{
    use JsonResponse, ImageUploader;
    public function getProfile()
    {
        try {
            $user = Auth::user();
            $roleName = $user->role->name;
            $user['roleName'] = $roleName;

            if (!$user) {
                return $this->json(false, 'Invalid token', null, 401);
            }

            return $this->json(true, 'Current user retrieved successfully', $user, 200);
        } catch (\Throwable $ex) {
            return $this->json(false, 'Unknown Error', $ex, 500);
        }
    }

    public function updateProfile(Request $request)
    {
        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'name' => 'required',
                ],
                [
                    'name.required' => 'Name is required',
                ],
            );

            if ($validator->fails()) {
                return $this->json(false, $validator->errors()->first(), null, 400);
            }

            $user = Auth::user();

            if (!$user) {
                return $this->json(false, 'Invalid token', null, 401);
            }
            // ['name', 'phoneNumber', 'gender', 'dateBirth', 'status', 'profile',  'defaultAddress'];

            $user->name = $request->name ?? $user->name;
            $user->phoneNumber = $request->phoneNumber ?? $user->phoneNumber;
            $user->gender = $request->gender ?? $user->gender;
            $user->dateBirth = $request->dateBirth ?? $user->dateBirth;
            $user->status = $request->status ?? $user->status;
            $user->defaultAddress = $request->defaultAddress ?? $user->defaultAddress;
            if ($request->hasFile('profile')) {
                $user->profile = $this->saveImage($request->profile, 'profile');
            }

            if ($user->save()) {
                $roleName = $user->role->name;
                $user['roleName'] = $roleName;
                return $this->json(true, 'Profile updated successfully', $user, 200);
            }
        } catch (\Throwable $ex) {
            return $this->json(false, 'Unknown Error', $ex, 500);
        }
    }

    public function updatePassword(Request $request)
    {
        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'oldPassword' => 'required',
                    'newPassword' => 'required',
                ],
                [
                    'oldPassword.required' => 'Old password is required',
                    'newPassword.required' => 'New password is required',
                ],
            );

            if ($validator->fails()) {
                return $this->json(false, $validator->errors()->first(), null, 400);
            }

            $user = Auth::user();

            if (!$user) {
                return $this->json(false, 'Invalid token', null, 401);
            }

            if (!Hash::check($request->oldPassword, $user->password)) {
                return $this->json(false, 'Old password is incorrect', null, 400);
            }

            $user->password = Hash::make($request->newPassword);
            if ($user->save()) {
                $roleName = $user->role->name;
                $user['roleName'] = $roleName;

                return $this->json(true, 'Password updated successfully', $user, 200);
            }
        } catch (\Throwable $ex) {
            return $this->json(false, 'Unknown Error', $ex, 500);
        }
    }

    public function logout()
    {
        try {
            if (Auth::check()) {
                Auth::user()->tokens()->delete();
                return $this->json(true, 'User logged out successfully', null, 200);
            }

            return $this->json(false, 'Invalid token', null, 401);
        } catch (\Throwable $ex) {
            return $this->json(false, 'Unknown Error', $ex, 500);
        }
    }

    public function delete()
    {
        try {
            if (Auth::check()) {
                $user = Auth::user();
                $user->tokens()->delete();
                $user->delete();
                return $this->json(true, 'User deleted out successfully', null, 200);
            }

            return $this->json(false, 'Invalid token', null, 401);
        } catch (\Throwable $ex) {
            return $this->json(false, 'Unknown Error', $ex, 500);
        }
    }
}
