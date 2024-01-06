<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Traits\ImageUploader;
use App\Traits\BaseValidator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthenticationController extends Controller
{
    use BaseValidator;
    use ImageUploader;



    

    public function login(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'email' => 'required|email',
                'password' => 'required|min:8',

            ],
            [
                'email.required' => 'Please enter your email address',
                'email.email' => 'Please enter a valid email',
                'password.required' => 'Please enter a password',
                'password.min' => 'The password must not be less than 8 characters',

            ]
        );
        if ($validator->fails()) {
            return response()->json(["message" => $validator->errors()->first()], 401);
        }


        $email = $request->email;
        $password = $request->password;

        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            $user = Auth::user();
            return response()->json(["message" => "User Login Successfully!"], 200);
        }
        return response()->json(["message" => "Incorrect email or password"], 401);
    }






    public function registr(Request $request)
    {

        $validator = Validator::make(
            $request->all(),

            [
                'profile' => 'required|image|mimes:png,jpg,jpeg|max:5120', // حجم الصورة يجب أن لا يتجاوز 5 ميجابايت
                'name' => 'required|max:60|regex:/^[\p{L}\s]+$/u',
                'email' => 'required|email|unique:users|max:255',
                'password' => 'required|confirmed|min:8',
            ],
            [
                'profile.required' => 'Please choose a profile picture',
                'profile.image' => 'Please select an image file',
                'profile.mimes' => 'The image must be a PNG, JPG, or JPEG file',
                'profile.max' => 'The image size should not exceed 5MB',
                'name.required' => 'Please enter your name',
                'name.max' => 'The name should not exceed 60 characters',
                'name.regex' => 'The name should only contain Arabic and English letters and spaces',
                'email.required' => 'Please enter your email address',
                'email.email' => 'Please enter a valid email',
                'email.unique' => 'This email address is already in use',
                'password.required' => 'Please enter a password',
                'password.min' => 'The password must not be less than 8 characters',
                'password.confirmed' => 'The password confirmation does not match',
            ]
        );



        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first(), 400);
        }



        $name = $request->name;
        $email = $request->email;
        $password = Hash::make($request->password);

        if ($request->hasFile('profile')) {
            $profile = $this->saveImage($request, 'profile', 'user/profile');
        }

        $user = User::create([
            'profile' => $profile,
            'name' => $name,
            'email' => $email,
            'password' => $password,

        ]);


        if ($user) {
            Auth::login($user);
            return $this->sendResponses('User Login Successfully!', 200);
        }
        return $this->sendError('Incorrect email or password', 400);
    }


    
}
