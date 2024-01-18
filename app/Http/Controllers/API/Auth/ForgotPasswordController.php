<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\BaseValidator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\NumberVerification;
use App\Traits\SendNotification;
use Symfony\Component\Routing\Loader\Configurator\Traits\AddTrait;

class ForgotPasswordController extends Controller
{
    use BaseValidator;
    use SendNotification;


    public function sendNewVerificationCode(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'phone_number' => 'required|max:255',

            ],
            [
                'phone_number.required' => 'Please enter your Phone Number address',
            ]
        );

        if ($validator->fails()) {
            return $this->sendError("error",$validator->errors()->first(), 400);
        }

        $phoneNumber = $request->phone_number;
        $verificationCode = rand(100000, 999999);

        NumberVerification::where('phone_number', $phoneNumber)->delete();

        $input['phone_number'] = $phoneNumber;
        $input['verificationCode'] = $verificationCode;

        $sendCode = NumberVerification::create($input);

        if (!$sendCode) {
            return $this->sendError("error",'An error occurred while sending the activation code');
        }

        $notification = $this->sendVerificationCode($phoneNumber, $verificationCode);
        return $this->sendResponses("Success",'Send Notification', $notification);
    }

    public function verifyPhoneNumber(Request $request)
    {

        $phoneNumber = $request->phone_number;
        $verificationCode = $request->verificationCode;

        $this->deleteExpiredCode();
        $row = NumberVerification::where('phone_number', $phoneNumber)->first();
        if ($row->phone_number != $phoneNumber || $row->verificationCode != $verificationCode) {
            return $this->sendError("error",'The verification code is invalid');
        }

        $row->delete();
        return $this->sendResponses("Success",'Account successfully created');
    }

    public function deleteExpiredCode()
    {
        $tableName = 'number_verification';
        $minutes  = Carbon::now()->subMinutes(15);
        DB::table($tableName)->where('created_at', '<=', $minutes)->delete();
        return $this->sendResponses("Success",'The verification code has expired');
    }

    public function createNewPassword(Request $request)
    {
        $phoneNumber = $request->phone_number;

        $newPassword = Hash::make($request->password);
        $user = User::where('phone_number', $phoneNumber)->first();
        if (!$user) {
            return $this->sendError("error",'The account could not be found');
        }



        if (Hash::check($request->password, $user->password)) {
            return $this->sendError("error",'You cannot use your old password');
        }


        $user->password = $newPassword;
        $user->save();

        return $this->sendResponses("Success",'The password has been updated successfully', $user); //'The password has been updated successfully');


    }
}
