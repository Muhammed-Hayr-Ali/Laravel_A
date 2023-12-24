<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\User;
use App\Mail\ForgotMail;
use Illuminate\Http\Request;
use App\Traits\BaseValidator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

class ForgotPasswordController extends Controller
{
    use BaseValidator;
    public function forgotPassword(Request $request)
    {
        $email = $request->email;

        if (User::where('email', $email)->doesntExist()) {
            return $this->sendError('This email address cannot be found');
        }
        $resetCode = rand(100000, 999999);

        $created_at = Carbon::now();
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $email],
            ['token' => $resetCode, 'created_at' => $created_at,]
        );

        // $success['email'] = $email;
        // $success['token'] = $resetCode;
        // $success['created_at'] = $created_at;

        // خذمة ارسال البريد
        //Mail::to($email)->send(new ForgotMail($resetCode));

        return $this->sendResponses('A password reset code has been sent, valid for 15 minutes');
    }






    // Verify verification code

    public function verifyVerificationCode(Request $request)
    {
        $tableName = 'password_reset_tokens';
        $email = $request->email;
        $code = $request->code;
        $time = Carbon::now();
        $accunt = DB::table($tableName)->where('email', $email)->first();

        if (!$accunt) {
            return $this->sendError('You have not requested a password recovery for this account');
        }

        if ($accunt->token != $code || $accunt->email != $email) {
            return $this->sendError('Email verification code is invalid');
        }

        $created_at = $accunt->created_at;

        if (Carbon::parse($created_at)->diffInMinutes($time) >= 16) {
            $this->deleteExpiredTokens();
            return $this->sendError('This code has expired. You can request the code again');
        }


        return $this->sendResponses('You can reset your password within 15 minutes');
    }




    public function createNewPassword(Request $request)
    {
        $tableName = 'password_reset_tokens';
        $email = $request->email;
        $code = $request->code;
        $newPassword = Hash::make($request->password);
        $user = User::where('email', $email)->first();



        if (Hash::check($request->password, $user->password)) {
            return $this->sendError('You cannot use your old password');
        }
        $user->password = $newPassword;
        $user->save();
        DB::table($tableName)->where('token', '=', $code)->delete();
        return $this->sendResponses('The password has been updated successfully', $user); //'The password has been updated successfully');


    }


    public function deleteExpiredTokens()
    {
        $tableName = 'password_reset_tokens';
        $minutes  = Carbon::now()->subMinutes(5);
        DB::table($tableName)->where('created_at', '<=', $minutes)->delete();
        return $this->sendResponses('The verification code has expired');
    }
}
