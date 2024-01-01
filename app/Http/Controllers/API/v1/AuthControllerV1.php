<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Requests\API\v1\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Resources\v1\UserResource;
use App\Http\Requests\API\v1\LoginUserRequest;
use Illuminate\Support\Facades\Auth;
use App\CustomProvider\ResponseProvider;
use Illuminate\Support\Str;

class AuthControllerV1
{
    use ResponseProvider;

    /**
     * Login a user and generate access token.
     *
     * @param  LoginUserRequest  $request
     *
     * @return JsonResponse
     */
    public function login(LoginUserRequest $request): JsonResponse
    {
        $credentials = $request->only(['email', 'password']);

        if (!Auth::attempt($credentials)) {
            return $this->jsonResponse(401, 'error', 'Incorrect Username or Password');
        }

        $user = User::where('email', $request->email)->first();

        $accessToken = $user->createToken("auth_token", ['*'], now()->addHours(3));

        $data = [
            'user'         => UserResource::make($user),
            'access_token' => $accessToken->plainTextToken,
            'token_type'   => 'Bearer',
        ];

        return $this->jsonResponse(201, 'success', 'User Logged In Successfully', $data);
    }

    /**
     * Register a new user.
     *
     * @param  StoreUserRequest  $request
     *
     * @return JsonResponse
     */
    public function register(StoreUserRequest $request): JsonResponse
    {
        User::create([
            'username'     => $request->username,
            'slug'     => Str::slug($request->username),
            'email'    => $request->email,
            'password' => $request->password,
        ]);

        return $this->jsonResponse(201,
            'success',
            'User Created Successfully'
        );
    }

    /**
     * Logout the authenticated user.
     *
     * @param  Request  $request
     *
     * @return JsonResponse
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return $this->jsonResponse(204);
    }
}
