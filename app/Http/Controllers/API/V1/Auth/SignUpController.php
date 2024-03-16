<?php

namespace App\Http\Controllers\API\V1\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\JsonResponse;
use App\Traits\ImageUploader;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SignUpController extends Controller
{
    use JsonResponse;
    use ImageUploader;

    public function signUp(Request $request)
    {
        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'name' => 'required|max:255',
                    'phoneNumber' => 'required|regex:/^[\d+-\/]{6,16}$/|unique:users',
                    'email' => 'required|email|max:255|unique:users',
                    'password' => 'required|min:8',
                    'gender' => 'required|in:Unspecified,Male,Female',
                    'status' => 'max:255',
                    'profile' => 'required|image|max:5000|mimes:jpeg,png,jpg',
                ],
                [
                    'name.required' => 'Please enter your Name',
                    'name.max' => 'Name must not exceed 255 characters',
                    'phoneNumber.required' => 'Please enter phone number',
                    'phoneNumber.regex' => 'The phone number must be between 6 to 16 digits',
                    'phoneNumber.unique' => 'The phone number already exists',
                    'email.required' => 'Please enter your email address',
                    'email.email' => 'Please enter a valid email',
                    'email.max' => 'The length of the email must not exceed 255 characters',
                    'email.unique' => 'Email already exists',
                    'password.required' => 'Password is required',
                    'password.min' => 'Password must be at least 8 characters',
                    'Confirm_Password.required' => 'Password confirmation is required',
                    'Confirm_Password.same' => 'Passwords do not match',
                    'gender.required' => 'Gender must be selected',
                    'gender.in' => 'Gender is invalid',
                    'status.max' => 'Status must not exceed 255 characters',
                    'profile.required' => 'At least one image is required',
                    'profile.image' => 'The selected image must be in JPEG, PNG, JPG, or GIF format',
                    'profile.max' => 'The selected image must not be larger than 5MB',
                    'profile.mimes' => 'The selected image must be in JPEG, PNG, JPG, or GIF format',
                ],
            );

            if ($validator->fails()) {
                return $this->json(false, $validator->errors()->first(), null, 422);
            }

            $input = $request->all();
            $input['password'] = Hash::make($input['password']);
            if ($request->hasFile('profile')) {
                $input['profile'] = $this->saveImage($request->profile, 'profile');
            }
            $user = User::create($input);
            $token = $user->createToken('accessToken')->accessToken;
            $user['roleName'] = 'User';

            return $this->json(
                true,
                'User registered successfully',
                [
                    'user' => $user,
                    'token' => $token,
                ],
                200,
            );
        } catch (\Throwable $ex) {
            return $this->json(false, $ex, null, 500);
        }
    }
}
