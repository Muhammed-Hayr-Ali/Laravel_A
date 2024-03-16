<?php

namespace App\Http\Controllers\API\V1\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CheckUserController extends Controller
{
    use JsonResponse;
    public function checkUser()
    {
        try {
            $user = Auth::user();

            if (!$user) {
                return $this->json(false, 'Invalid token', null, 401);
            }

            $roleName = $user->role->name;

            $user['roleName'] = $roleName;

            return $this->json(
                true,
                'Current user retrieved successfully',
                [
                    'user' => $user,
                ],
                200,
            );
        } catch (\Throwable $ex) {
            return $this->json(false, 'Unknown Error', $ex, 500);
        }
    }
}
