<?php

declare(strict_types=1);

namespace App\Transformers;

use App\Dto\UserResponseDto;
use Illuminate\Support\Arr;

final class UserTransformer
{
    public static function fromApiResponse(array $data): UserResponseDto
    {
        return new UserResponseDto(
            id: (int) Arr::get($data, 'id', 0),
            name: (string) Arr::get($data, 'name', ''),
            email: (string) Arr::get($data, 'email', ''),
            city: (string) Arr::get($data, 'address.city', ''),
            company: (string) Arr::get($data, 'company.name', '')
        );
    }
}