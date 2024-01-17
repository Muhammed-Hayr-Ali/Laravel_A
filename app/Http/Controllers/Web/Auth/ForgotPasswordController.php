<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Settings;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;


class ForgotPasswordController extends Controller
{
 


    public function index()
    {

        $settings = Settings::first();
        if ($settings) {
            $data['siteName'] =  $settings->siteName;
            $data['logo'] =  $settings->logo;
            $data['year'] =  Carbon::now()->year;
        } else {
            $data['siteName'] =  'Marketna';
            $data['logo'] =  "assets/website/img/logo.png";
            $data['year'] = "2024";
        }

        return view('auth.forgot_password', compact('data'));
    }


    public function store(Request $request)
    {
        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'email' => 'required|email',
                ],
                [
                    'email.required' => 'Please enter your email address',
                    'email.email' => 'Please enter a valid email',

                ]
            );
            if ($validator->fails()) {
                return back()->withInput()->with('error', $validator->errors()->first());
            }
            $email = $request->email;

            // if (Auth::attempt(['email' => $email, 'password' => $password])) {
            //     return redirect()->back();
            // }
            return back()->withInput()->with('error', 'An unknown error has occurred');
        } catch (\Exception $ex) {

            return back()->withInput()->with('error', $ex->getMessage());
        }
    }
}
