<?php

namespace App\Http\Controllers\Dashboard\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Role;
use App\Traits\ImageUploader;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use App\Traits\SendNotification;

class UserController extends Controller
{
    use ImageUploader;
    use SendNotification;

    // INDEX OK!!
    public function index()
    {
        $users = User::all();
        return view('dashboard.User.index', compact('users'));
    }

    // CREATE OK!!
    public function create()
    {
        return view('dashboard.User.create');
    }

    // STORE OK!!
    public function store(Request $request)
    {
        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'name' => 'required|max:255',
                    'phoneNumber' => 'regex:/^[\d+-\/]{6,16}$/|required|unique:users',
                    'email' => 'required|email|max:255|unique:users',
                    'password' => 'required|min:8',
                    'Confirm_Password' => 'required|same:password',
                    'role_id' => 'required',
                    'gender' => 'required|in:Unspecified,Male,Female',
                    'status' => 'max:255',
                    'profile' => 'required|image|max:5000|mimes:jpeg,png,jpg',
                ],
                [
                    'name.required' => 'Enter the user name',
                    'name.max' => 'Name must not exceed 255 characters',
                    'phoneNumber.required' => 'Please enter phone number',
                    'phoneNumber.regex' => 'The phone number must be between 6 to 16 digits',
                    'phoneNumber.unique' => 'The phone number already exists',
                    'email.required' => 'Email is required',
                    'email.email' => 'Email must be valid',
                    'email.max' => 'Email must not exceed 255 characters',
                    'email.unique' => 'Email already exists',
                    'password.required' => 'Password is required',
                    'password.min' => 'Password must be at least 8 characters',
                    'Confirm_Password.required' => 'Password confirmation is required',
                    'Confirm_Password.same' => 'Passwords do not match',
                    'role_id.required' => 'Role must be selected',
                    'role_id.integer' => 'Role must be a number',
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
                $errorField = $validator->errors()->keys()[0];
                return $this->sendError($errorField, __('validators.' . $validator->errors()->first()), 400);
            }

            $user = new User();
            $user->name = $request->name;
            $user->phoneNumber = $request->phoneNumber;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->role_id = $request->role_id ?? 3;
            $user->expirationDate = $request->expirationDate ? Carbon::parse($request->expirationDate)->setTimeFromTimeString(Carbon::now()->toTimeString()) : null;
            $user->gender = $request->gender ? $request->gender : 'unspecified';
            $user->dateBirth = $request->dateBirth ?? null;
            $user->status = $request->status ?? null;
            if ($request->hasFile('profile')) {
                $user->profile = $this->saveImage($request->profile, 'profile');
            }

            $user->save();

            return $this->sendResponses('Success', __('responses.:_THIS_VAR_ has been added successfully', ['_THIS_VAR_' => __('the user')]), 200);
        } catch (\Exception $e) {
            return $this->sendError('error', $e->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    // EDIT OK!!
    public function edit(string $id)
    {
        $user = User::find($id);
        if (!$user) {
            return back()->with('error', __('responses.:_THIS_VAR_ not found', ['_THIS_VAR_' => __('the user')]));
        }

        return view('dashboard.User.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try {
            $id = $request->id;
            $user = User::findOrFail($id);
            if (!$user) {
                return back()->with('error', __('responses.:_THIS_VAR_ not found', ['_THIS_VAR_' => __('the user')]));
            }

            $validator = Validator::make(
                $request->all(),
                [
                    'name' => 'required|max:255',
                    'phoneNumber' => 'required|regex:/^[\d+-\/]{6,16}$/|unique:users,phoneNumber,' . $user->id,
                    // 'email' => 'required|email|max:255|unique:users,email,' . $user->id,
                    'password' => '',
                    'Confirm_Password' => 'same:password',
                    'role_id' => 'required',
                    'gender' => 'required|in:Unspecified,Male,Female',
                    'status' => 'max:255',
                ],
                [
                    'name.required' => 'Enter the user name',
                    'name.max' => 'Name must not exceed 255 characters',
                    'phoneNumber.regex' => 'The phone number must be between 6 to 16 digits',
                    'phoneNumber.unique' => 'The phone number already exists',
                    // 'email.required' => 'Email is required',
                    // 'email.email' => 'Email must be valid',
                    // 'email.max' => 'Email must not exceed 255 characters',
                    // 'email.unique' => 'Email already exists',
                    // 'password.required' => 'Password is required',
                    // 'password.min' => 'Password must be at least 8 characters',
                    'Confirm_Password.required' => 'Password confirmation is required',
                    'Confirm_Password.same' => 'Passwords do not match',
                    'role_id.required' => 'Role must be selected',
                    'role_id.integer' => 'Role must be a number',
                    'gender.required' => 'Gender must be selected',
                    'gender.in' => 'Gender is invalid',
                    'status.max' => 'Status must not exceed 255 characters',
                ],
            );

            if ($validator->fails()) {
                $errorField = $validator->errors()->keys()[0];
                return $this->sendError($errorField, __('validators.' . $validator->errors()->first()), 400);
            }

            if ($user->profile == null) {
                $validator = Validator::make(
                    $request->all(),
                    [
                        'profile' => 'required|image|max:5000|mimes:jpeg,png,jpg',
                    ],
                    [
                        'profile.required' => 'At least one image is required',
                        'profile.image' => 'The selected image must be in JPEG, PNG, JPG, or GIF format',
                        'profile.max' => 'The selected image must not be larger than 5MB',
                        'profile.mimes' => 'The selected image must be in JPEG, PNG, JPG, or GIF format',
                    ],
                );

                if ($validator->fails()) {
                    $errorField = $validator->errors()->keys()[0];
                    return $this->sendError($errorField, __('validators.' . $validator->errors()->first()), 400);
                }
            }

            $user->name = $request->name ?? $user->name;
            $user->phoneNumber = $request->phoneNumber ?? $user->phoneNumber;
            $password = $request->password ?? Hash::make($request->password);
            $user->expirationDate = $request->expirationDate ? Carbon::parse($request->expirationDate)->setTimeFromTimeString(Carbon::now()->toTimeString()) : null;
            $user->gender = $request->gender ?? $user->gender;
            $user->role_id = $request->role_id ?? $user->role_id;
            $user->dateBirth = $request->dateBirth ?? null;
            $user->status = $request->status ?? null;
            $user->profile = $request->hasFile('profile') ? $this->saveImage($request->profile, 'profile') : $user->profile;

            $user->update();

            return $this->sendResponses('Success', __('responses.:_THIS_VAR_ has been Updated successfully', ['_THIS_VAR_' => __('the user')]));
        } catch (\Exception $e) {
            return $this->sendError('error', $e->getMessage(), 500);
        }
    }

    //GetImages OK!!
    public function getImages(Request $request)
    {
        $id = $request->id;
        $user = User::find($id);

        return view('dashboard.User.components.images', compact('user'));
    }

    //Delete Image OK!!
    public function deleteImage(Request $request)
    {
        try {
            $id = $request->id;
            $user = User::find($id);

            if (!$user) {
                return $this->sendError('Error', __('responses.:_THIS_VAR_ not found', ['_THIS_VAR_' => __('the user')]), 404);
            }

            $path = $user->profile;
            if (file_exists($path)) {
                unlink($path);
            }

            $user->profile = null;
            $user->save();

            return $this->sendResponses('Success', __('responses.Image deleted successfully'), 200);
        } catch (\Exception $e) {
            return $this->sendError('Error', $e->getMessage(), 500);
        }
    }

    //Delete OK!!
    public function destroy(string $id)
    {
        try {
            $user = User::find($id);
            if (!$user) {
                return $this->sendError('Error', __('responses.:_THIS_VAR_ not found', ['_THIS_VAR_' => __('the user')]), 404);
            }

            $name = __($user->name);
            $count = $user->products->count();

            if ($count > 0) {
                return $this->sendError('Error', __('responses.:_THIS_VAR_ :_KEY_ contains :_VALUE_ products that must be deleted or moved to another : _VAR_  in order to be able to delete :_THIS_VAR_', ['_THIS_VAR_' => __('the user'), '_VAR_' => __('user'), '_KEY_' => $name, '_VALUE_' => $count]), 404);
            }

            $image = $user->image;
            $user->delete();
            if ($image) {
                $path = $image;
                if (file_exists($path)) {
                    unlink($path);
                }
            }

            return $this->sendResponses('Success', __('responses.:_THIS_VAR_ deleted successfully', ['_THIS_VAR_' => __('the user')]), 200);
        } catch (\Exception $e) {
            return $this->sendError('Error', $e->getMessage(), 500);
        }
    }

    public function verify(Request $request)
    {
        $user = User::find($request->id);
        $user->email_verified_at = Carbon::now();
        $user->save();
        return $this->sendResponses('Success', __('responses.:_THIS_VAR_ has been Updated successfully', ['_THIS_VAR_' => __('the user')]));
    }
}
