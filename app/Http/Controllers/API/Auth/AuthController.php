<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Traits\BaseValidator;
use App\Traits\ImageUploader;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Arr;



class AuthController extends Controller
{
    use BaseValidator;
    use ImageUploader;
    use HasApiTokens;




    public function checkMailAvailability(Request $request)
    {
        $email = $request->email;
        if (User::where('email', $email)->exists()) {
            return $this->sendError('This email address is already in use.');
        }
            return $this->sendResponses('This email is available', $email);
        
    }

    public function register(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users|max:255',
                'password' => 'required',

            ],
            [
                'name.required' => 'Please enter your name.',
                'email.required' => 'Please enter your email address.',
                'email.unique' => 'This email address is already in use.',
                'password.required' => 'Please enter a password.',
            ]
        );

        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first(), 400);
        }


        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        if ($request->hasFile('profile')) {
            $input['profile'] = $this->saveImage($request, 'profile', 'user/profile');
        }


        $user = User::create($input);
        $success['profile'] = $user;
        $success['profile']['token'] = $user->createToken('accessToken')->accessToken;

        return $this->sendResponses('Account successfully created', $success);
    }

    public function login(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'email' => 'required|email|max:255',
                'password' => 'required|max:255',
            ],
            [
                'email.required' => 'Please enter your email address.',
                'password.required' => 'Please enter a password.',
            ]
        );


        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first(), 400);
        }

        $input = $request->all();
        if (Auth::attempt($input)) {
            $user = $request->user();
            $success['profile'] = $user;
            $success['profile']['token'] = $user->createToken('accessToken')->accessToken;
            return $this->sendResponses('User Login Successfully!', $success);
        } else {
            return $this->sendError('Incorrect email or password', 401);
        }
    }




    public function continueWithGoogle(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'password' => 'required',

            ],
            [
                'name.required' => 'Please enter your name.',
                'email.required' => 'Please enter your email address.',
                'password.required' => 'Please enter a password.',
            ]
        );

        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first(), 400);
        }


        $input = $request->all();

        $user = User::where('email', $input['email'])->first();

        if ($user) {
            if (Auth::attempt($input)) {
                $user = $request->user();
                $success['profile'] = $user;
                $success['profile']['token'] = $user->createToken('accessToken')->accessToken;
                return $this->sendResponses(false, $success);
            } else {
                return $this->sendError('Incorrect email or password', 401);
            }
        } else {
            $input['password'] = Hash::make($input['password']);
            $user = User::create($input);
            $success['profile'] = $user;
            $success['profile']['token'] = $user->createToken('accessToken')->accessToken;
            return $this->sendResponses(true, $success);
        }
    }






    public function logout(Request $request)
    {
        $token = $request->user()->token();
        $token->revoke();
        return $this->sendResponses('User Logout Successfully');
    }
}
