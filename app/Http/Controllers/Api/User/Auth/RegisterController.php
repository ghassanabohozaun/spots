<?php

namespace App\Http\Controllers\Api\User\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Services\Dashboard\UserService;
use App\Traits\ApiResponse;

class RegisterController extends Controller
{
    use ApiResponse;
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    // register
    public function register(RegisterRequest $request)
    {
        $user = $this->userService->storeUser($request->validated());
        $token = $user->createToken('user_auth_token', ['*'], now()->addWeek())->plainTextToken;
        $data = ['user' => new UserResource($user), 'token' => $token];
        return $this->ApiResponse($data,true, __("general.add_success_message"), 200);
    }
}
