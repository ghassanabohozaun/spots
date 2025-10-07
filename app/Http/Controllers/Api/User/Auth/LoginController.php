<?php

namespace App\Http\Controllers\Api\User\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\LoignRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    use ApiResponse;

    // login
    public function login(LoignRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || Hash::check($request->password, $user->password) == false) {
            return $this->ApiResponse(null, false,'Invalid User', 401);
        }

        // if ($user->id == 1) {
        //     $token = $user->createToken('auth_token', ['read' , 'write','update','delete'], now()->addWeek())->plainTextToken;
        // } else {
        //     $token = $user->createToken('auth_token', ['read'], now()->addWeek())->plainTextToken;
        // }

        $token = $user->createToken('user_auth_token', ['*'], now()->addMonth())->plainTextToken;
        $data = ['user' => new UserResource($user), 'token' => $token];
        return $this->ApiResponse($data,true, __('general.login_success'), 200);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return $this->ApiResponse(null,true, __('general.logout_success'), 200);
    }
}
