<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Traits\ImageUploader;
use App\Traits\BaseResponse;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    use BaseResponse;
    use ImageUploader;

    public function logout()
    {
        try {
            $user = Auth::user();
            if ($user) {
                Auth::logout();
                return redirect('/');
            }
        } catch (\Exception $ex) {
            return $this->sendError($ex->getMessage(), 500);
        }
    }
}
