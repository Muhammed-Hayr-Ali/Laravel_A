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

            // Delete expired reset codes
            ResetPass::where('created_at', '<', now()->subMinutes(15))->delete();

            // Find the latest valid reset code
            $email = ResetPass::where('email', $request->email)
                ->latest('created_at')
                ->first();

            if (!$email) {
                return $this->json(false, 'Invalid email', null, 404);
            }

            // Check if the provided reset code is valid
            if ($email->resetCode != $request->resetCode) {
                return $this->json(false, 'Invalid reset code', null, 404);
            }

            // Update the user's password
            $user = User::where('email', $request->email)->first();
            $user->password = Hash::make($request->password);
            $user->save();

            // Delete the reset code
            $email->delete();

            return $this->json(true, 'Password updated successfully', null, 200);
        } catch (\Throwable $ex) {
            return $this->json(false, 'Unknown Error', $ex, 500);
        }
    }
}
