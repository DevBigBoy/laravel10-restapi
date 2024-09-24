<?php

namespace App\Http\Controllers\Api\Auth;

use Exception;
use App\Traits\HttpResponses;
use App\Services\RegisterService;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterUserRequest;

class RegisterController extends Controller
{
    use HttpResponses;

    public function __construct(
        public RegisterService $registerService
    ) {}


    public function register(RegisterUserRequest $request)
    {
        try {
            DB::beginTransaction();

            $user = $this->registerService->userRegister($request);

            DB::commit();

            return $this->success([
                'user' => $user,
                'token' => $user->createToken('Personal Access Token', ['app:all'])->plainTextToken,
            ], 'User registered successfully', 200);
        } catch (Exception $e) {
            DB::rollBack();

            return $this->error([], $e->getMessage());
        }
    }
}