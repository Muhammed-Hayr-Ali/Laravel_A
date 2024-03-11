<?php

namespace App\Http\Controllers\API\V1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Traits\JsonResponse;
use App\Models\User;
use App\Models\ResetPass

class ResetPassController extends Controller
{
    use JsonResponse;

    public function resetPass(Request $request)
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
                ],
            );

            if ($validator->fails()) {
                return $this->json(false, $validator->errors()->first(), null, 422);
            }

            $email = User::where('email', $request->email)->first();

            if (!$email) {
                return $this->json(false, 'Email not found', null, 404);
            }

            $resetPass = new ResetPass();
            $resetPass->email = $request->email;
            $resetPass->resetCode = rand(100000, 999999);
            $resetPass->save();


            return $this->json(true, 'Code sent successfully', null, 200);

        } catch (\Throwable $ex) {
            return $this->json(false, $ex, null, 500);
        }
    }
}
