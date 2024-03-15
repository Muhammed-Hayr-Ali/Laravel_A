<?php

namespace App\Http\Controllers\API\V1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Traits\JsonResponse;
use App\Models\User;
use App\Models\ResetPass;
use App\Mail\ResetPassMail;
use Illuminate\Support\Facades\Mail;

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

            $resetCode = rand(100000, 999999);
            $resetPass = new ResetPass();
            $resetPass->email = $request->email;
            $resetPass->resetCode = $resetCode;
            $resetPass->save();

            try {
                Mail::to($request->email)->send(new ResetPassMail($resetCode));
                return $this->json(true, 'Code sent successfully', null, 200);
            } catch (\Exception $ex) {
                return $this->json(false, 'Failed to send email', null, 500);
            }
        } catch (\Throwable $ex) {
            if ($ex == MailException) {
                return $this->json(false, 'XXXXXX', null, 404);
            }
            return $this->json(false, $ex, null, 500);
        }
    }
}
