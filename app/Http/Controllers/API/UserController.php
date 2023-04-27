<?php

namespace App\Http\Controllers\API;

use App\Enums\UserRoleEnum;
use App\Helpers\ResponseMapper;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\auth\LoginRequest;
use App\Http\Requests\API\auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    
    public function login(LoginRequest $loginRequest)
    {
        $loginRequest->validated();
        $credentials = request(['email','password']);
        if(!$this->attempt($credentials)) {
            return ResponseMapper::error([
                'message' => 'Unauthorized',
            ],'Authentication Failed', 500);
        }
        $user = $this->getUserCredential($credentials);
        if(!$this->check($credentials, $user)) {
            throw new \App\Exceptions\ApiException('Invalid credentials');
        }
        $token = $this->createToken($user);

        return ResponseMapper::success([
            'access_token' => $token,
        ], 'Authenticated');
    }

    public function logout(Request $request)
    {
        $token = $request->user()->currentAccessToken()->delete();
        if($token) {
            return ResponseMapper::success($token, "User logout");
        }
        return ResponseMapper::error($token, "User failed logout", 403);
    }
    
    public function register(RegisterRequest $registerRequest)
    {   
        $registerRequest->validated();
        $user = $this->create($registerRequest->only(['name','email','password']));
        return ResponseMapper::success($user, 'User created');
    }

    private function create($data) {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'role' => UserRoleEnum::CUSTOMER,
            'password' => Hash::make($data['password']),
        ]);
    }
    
    private function attempt($credentials): bool
    {
        return Auth::attempt($credentials);
    }
    
    private function check($credentials, $user): bool
    {
        return Hash::check($credentials['password'], $user->password,[]);
    }

    private function getUserCredential($credentials) {
        return User::where('email',$credentials['email'])->first();
    }

    private function createToken($user)
    {
        return $user->createToken('authToken')->plainTextToken;
    }
}
