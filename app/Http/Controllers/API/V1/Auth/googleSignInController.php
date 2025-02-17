<?php

namespace App\Http\Controllers\API\V1\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class googleSignInController extends Controller
{
    use JsonResponse;

    public function googleSignIn(Request $request)
    {
        try {
            //محاولة تسجيل الدخول باستخدام بيانات المستخدم
            $user = User::where('email', $request->email)->first();
            if ($user) {
                $input = ['email' => $request->email, 'password' => $request->password];
                $user = Auth::attempt($input);
                if ($user) {
                    $user = Auth::user();
                    $token = $user->createToken('accessToken')->accessToken;

                    $roleName = $user->role->name;
                    $user['roleName'] = $roleName;

                    return $this->json(
                        true,
                        'User logged in successfully',
                        [
                            'user' => $user,
                            'token' => $token,
                        ],
                        200,
                    );
                }
            }

            // انشاء حساب جديد للمستخدم
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->profile = $request->profile;
            $user['roleName'] = 'User';
            $user->save();

            $input = ['email' => $request->email, 'password' => $request->password];
            $user = Auth::attempt($input);
            if ($user) {
                $user = Auth::user();
                $token = $user->createToken('accessToken')->accessToken;
                return $this->json(
                    true,
                    'The user has been registered and logged in successfully',
                    [
                        'user' => $user,
                        'token' => $token,
                    ],
                    200,
                );
            }

            return $this->json(false, 'Invalid credentials', null, 401);
        } catch (\Throwable $ex) {
            return $this->json(false, 'Unknown Error', $ex, 500);
        }
    }
}
