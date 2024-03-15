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

            if (!$user) {
                return $this->json(false, 'Invalid token', null, 401);
            }

            return $this->json(true, 'Current user retrieved successfully', $user, 200);
        } catch (\Throwable $ex) {
            return $this->json(false, $ex, null, 500);
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
                return $this->json(true, 'Profile updated successfully', $user, 200);
            }
        } catch (\Throwable $ex) {
            return $this->json(false, $ex, null, 500);
        }
    }
}
