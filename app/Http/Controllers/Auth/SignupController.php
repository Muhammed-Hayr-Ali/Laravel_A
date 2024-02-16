<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Settings;
use Illuminate\Support\Carbon;
use App\Traits\ImageUploader;
use App\Traits\BaseResponse;

use Illuminate\Support\Facades\Validator;

class SignupController extends Controller
{
    use ImageUploader;
    use BaseResponse;

    public function index()
    {
        return view('auth.signup');
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'name' => 'required|max:255',
                    'phoneNumber' => 'required|regex:/^[\d+-\/]{6,16}$/|unique:users',
                    'email' => 'required|email|max:255|unique:users',
                    'password' => 'required|min:8',
                    'Confirm_Password' => 'required|same:password',
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
                return back()
                    ->withInput()
                    ->with('error', __('validators.' . $validator->errors()->first()));
            }

            $user = new User();
            $user->name = $request->name;
            $user->phoneNumber = $request->phoneNumber;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->role_id = 3;
            $user->expirationDate = $request->expirationDate ? Carbon::parse($request->expirationDate)->setTimeFromTimeString(Carbon::now()->toTimeString()) : null;
            $user->gender = $request->gender ? $request->gender : 'unspecified';
            $user->dateBirth = $request->dateBirth ?? null;
            $user->status = $request->status ?? null;
            if ($request->hasFile('profile')) {
                $user->profile = $this->saveImage($request->profile, 'profile');
            }

            $user->save();

            if ($user) {
                // Cart::create([
                //     'user_id' => $user->id,
                // ]);
                Auth::login($user);
                return redirect()->back();
            }
        } catch (\Exception $ex) {
            return back()->withInput()->with('error', $ex->getMessage());
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
