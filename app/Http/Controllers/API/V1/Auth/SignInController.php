<?php

namespace App\Http\Controllers\API\V1\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SignInController extends Controller
{
    use JsonResponse;

    public function signIn(Request $request)
    {
        try {
            // التحقق من صحة البيانات المدخلة
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
                return $this->json(false, $validator->errors()->first(), null, 422);
            }

            // محاولة تسجيل الدخول باستخدام بيانات المستخدم
            $credentials = $request->only('email', 'password');
            if (!Auth::attempt($credentials)) {
                return $this->json(false, 'Invalid email or password', null, 401);
            }

            // إنشاء توكن الوصول للمستخدم
            $user = Auth::user();
            $token = $user->createToken('accessToken')->accessToken;;

            // إعادة الاستجابة بمستخدم المسجل وتوكن الوصول
            return $this->json(
                true,
                'User logged in successfully',
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
