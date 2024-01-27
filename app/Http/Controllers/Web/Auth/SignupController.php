<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Settings;
use Illuminate\Support\Carbon;
use App\Traits\ImageUploader;
use Illuminate\Support\Facades\Validator;

class SignupController extends Controller
{
    use ImageUploader;

    public function index()
    {
        $settings = Settings::first();
        if ($settings) {
            $data['siteName'] = $settings->siteName;
            $data['logo'] = $settings->logo;
            $data['year'] = Carbon::now()->year;
        } else {
            $data['siteName'] = 'Marketna';
            $data['logo'] = 'assets/website/img/logo.png';
            $data['year'] = '2024';
        }

        return view('auth.signup', compact('data'));
    }

    public function store(Request $request)
    {
        try {
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
                ],
            );

            if ($validator->fails()) {
                return back()
                    ->withInput()
                    ->with('error', $validator->errors()->first());
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

            $cart = Cart::create([
                'user_id' => $user->id,
            ]);

            if ($user) {
                Auth::login($user);
                return redirect()->back();
            }
            return back()
                ->withInput()
                ->with('error', 'An unknown error has occurred');
        } catch (\Exception $ex) {
            return back()
                ->withInput()
                ->with('error', $ex->getMessage());
        }
    }
    public function logout()
    {
        try {
            $user = Auth::user();
            if ($user) {
                Auth::logout();
                return redirect('/');
            }
        } catch (\Exception $ex) {
            return $this->sendError($ex->getMessage(), 500);
        }
    }
}
