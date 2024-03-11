<?php

namespace App\Http\Controllers\API\V1\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class GetUserController extends Controller
{
    use JsonResponse;
    public function getUser()
    {
        try {
            $user = Auth::user();

            if (!$user) {
                return $this->json(false, 'Invalid token', null, 401);
            }

            return $this->json(true, 'Current user retrieved successfully', $user, 200);
        } catch (\Throwable $ex) {
            return $this->json(false, $ex, null, 500);
        }
    }
}
