<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Contracts\Services\UserServiceInterface;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    private readonly UserServiceInterface $userService;
    
    public function __construct(UserServiceInterface $userService) {
        $this->userService = $userService;
    }

    public function show(): JsonResponse
    {
        $userData = $this->userService->getUser(1);

        return response()->json($userData);
    }
}
