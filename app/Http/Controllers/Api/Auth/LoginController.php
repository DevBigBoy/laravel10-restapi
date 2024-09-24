<?php

namespace App\Http\Controllers\Api\Auth;

use Exception;
use App\Models\User;
use App\Traits\HttpResponses;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\LoginRequest;

class LoginController extends Controller
{
    use HttpResponses;
    /**
     * Handle the incoming request.
     */
    public function __invoke(LoginRequest $request)
    {
        try {
            $user = User::where('email', $request->email)->first();

            if (!$user || ! Hash::check($request->password, $user->password)) {
                return $this->error([], '', 401);
            }

            if ($user->status != 'active') {
                return $this->error([], '', 401);
            }

            $data = [
                'user' => $user,
                'token' => $user->createToken('Api Token of' . $user->name)->plainTextToken
            ];

            return $this->success($data, '', 200);
        } catch (Exception $e) {
            return $this->error([], $e->getMessage());
        }
    }
}