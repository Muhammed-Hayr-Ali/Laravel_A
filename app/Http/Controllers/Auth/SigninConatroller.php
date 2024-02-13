<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Settings;
use Illuminate\Support\Carbon;

class SigninConatroller extends Controller
{
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

        return view('auth.login', compact('data'));
    }

    public function store(Request $request)
    {
        try {
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
                ],
            );
            if ($validator->fails()) {
                return back()
                    ->withInput()
                    ->with('error', 'validators.' . $validator->errors()->first());
            }
            $email = $request->email;
            $password = $request->password;

            if (Auth::attempt(['email' => $email, 'password' => $password])) {
                return redirect()->route('index');
            }
            return back()->withInput()->with('error', 'responses.Incorrect email or password');
        } catch (\Exception $ex) {
            return back()->withInput()->with('error', $ex->getMessage());
        }
    }
}
