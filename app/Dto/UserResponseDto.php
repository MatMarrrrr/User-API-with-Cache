<?php

declare(strict_types=1);

namespace App\Dto;

use JsonSerializable;

final class UserResponseDto implements JsonSerializable
{
    public readonly int $id;
    public readonly string $name;
    public readonly string $email;
    public readonly string $city;
    public readonly string $company;

    public function __construct(
        int $id,
        string $name,
        string $email,
        string $city,
        string $company,
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->city = $city;
        $this->company = $company;
    }

    public function jsonSerialize(): array
    {
        return [
            'id'      => $this->id,
            'name'    => $this->name,
            'email'   => $this->email,
            'city'    => $this->city,
            'company' => $this->company,
        ];
    }
}

