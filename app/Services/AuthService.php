<?php

namespace App\Services;

use App\Repositories\Contracts\UserRepositoryInterface;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    protected $userRepo;

    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function register(array $data)
    {
        if ($this->userRepo->findByEmail($data['email'])) {
            throw new Exception('Email already registered');
        }

        $data['password'] = Hash::make($data['password']);
        $user = $this->userRepo->create($data);
        $token = $user->createToken('auth')->plainTextToken;
        return [
            'user' => $user,
            'token' => $token
        ];
    }

    public function login(array $data)
    {
        $user = $this->userRepo->findByEmail($data['email']);

        if (!$user || !Hash::check($data['password'], $user->password)) {
            throw new Exception('Invalid Credentials');
        }

        $token = $user->createToken('auth')->plainTextToken;

        return [
            'user' => $user,
            'token' => $token
        ];
    }

    public function logout($user){
        $user->tokens()->delete();
    }

    public function me($user){
        return $user;
    }
}
