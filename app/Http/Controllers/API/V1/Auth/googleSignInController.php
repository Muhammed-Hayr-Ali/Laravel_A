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
            $user->save();


            $input = ['email' => $request->email, 'password' => $request->password];
            $user = Auth::attempt($input);
            if ($user) {
                $user = Auth::user();
                $token = $user->createToken('accessToken')->accessToken;
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

            return $this->json(false, 'Invalid credentials', null, 401);

        } catch (\Throwable $ex) {
            return $this->json(false, $ex, null, 500);
        }
    }
}

//             // التحقق من صحة البيانات المدخلة
//             $validator = Validator::make(
//                 $request->all(),
//                 [
//                     'name' => 'required',
//                     'email' => 'required|email',
//                     'password' => 'required|min:8',
//                 ],
//                 [
//                     'email.required' => 'Please enter your email address',
//                     'email.email' => 'Please enter a valid email',
//                     'password.required' => 'Please enter a password',
//                     'password.min' => 'The password must not be less than 8 characters',
//                 ],
//             );

//             if ($validator->fails()) {
//                 return $this->json(false, $validator->errors()->first(), null, 422);
//             }

//             // محاولة تسجيل الدخول باستخدام بيانات المستخدم
//             $credentials = $request->only('email', 'password');
//             if (!Auth::attempt($credentials)) {
//                 return $this->json(false, 'Invalid email or password', null, 401);
//             }

//             // إنشاء توكن الوصول للمستخدم
//             $user = Auth::user();
//             $token = $user->createToken('accessToken')->accessToken;;

//             // إعادة الاستجابة بمستخدم المسجل وتوكن الوصول
//             return $this->json(
//                 true,
//                 'User logged in successfully',
//                 [
//                     'user' => $user,
//                     'token' => $token,
//                 ],
//                 200,
//             );
//         } catch (\Throwable $ex) {
//             return $this->json(false, $ex, null, 500);
//         }
//     }
// }
