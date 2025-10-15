<?php

declare(strict_types=1);

namespace App\Contracts\Services;

use App\Dto\UserResponseDto;

interface UserServiceInterface
{
    public function getUser(int $id): UserResponseDto;
}
