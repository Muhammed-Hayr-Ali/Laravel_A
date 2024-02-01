<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\BaseResponse;
use App\Models\User;

class UsersConatroller extends Controller
{
    use BaseResponse;

    public function userProfile(Request $request)
    {
        try {
            $id = $request->id;
            $user = User::find($id);
            if (!$user) {
                return $this->sendError(__('Error'), __('User Not Found'), 500);
            }
            return view('admin.orders.user_profile', compact('user'));
        } catch (\Exception $ex) {
            return $this->sendError('error', $ex->getMessage(), 500);
        }
    }
}
