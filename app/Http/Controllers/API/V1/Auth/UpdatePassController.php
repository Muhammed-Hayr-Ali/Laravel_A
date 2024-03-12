<?php

namespace App\Http\Controllers\API\V1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Traits\JsonResponse;
use App\Models\User;
use App\Models\ResetPass;
use Illuminate\Support\Facades\Hash;

class UpdatePassController extends Controller
{
    use JsonResponse;

    public function updatePass(Request $request)
    {
        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'email' => 'required|email',
                    'resetCode' => 'required',
                    'password' => 'required',
                ],
                [
                    'email.required' => 'Please enter your email address',
                    'email.email' => 'Please enter a valid email',
                    'resetCode.required' => 'Please enter your reset code',
                    'password.required' => 'Please enter your password',
                ],
            );

            if ($validator->fails()) {
                return $this->json(false, $validator->errors()->first(), null, 422);
            }

            $email = ResetPass::where('email', $request->email)->first();

            if (!$email) {
                return $this->json(false, 'Email not found', null, 404);
            }

            if ($email->resetCode != $request->resetCode) {
                return $this->json(false, 'Invalid reset code', null, 404);
            }

            $user = User::where('email', $request->email)->first();
            $user->password = Hash::make($request->password);
            $user->save();
            $email->delete();

            


            return $this->json(true, 'Password updated successfully', null, 200);


        } catch (\Throwable $ex) {
            return $this->json(false, $ex, null, 500);
        }
    }
}
