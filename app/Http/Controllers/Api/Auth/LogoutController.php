<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    use HttpResponses;
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $token = $request->user()->currentAccessToken();
        $token->delete();
        return $this->success([], 'You have Successfully been logged out and your token has been deleted!');
    }
}