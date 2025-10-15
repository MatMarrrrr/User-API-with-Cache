<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\Services\UserServiceInterface;
use App\Dto\UserResponseDto;
use App\Transformers\UserTransformer;
use Illuminate\Contracts\Cache\Repository as CacheRepository;
use Illuminate\Support\Facades\Http;

final class UserService implements UserServiceInterface
{
    private const CACHE_TTL_SECONDS = 60;
    private const API_TIMEOUT_SECONDS = 5;

    private readonly CacheRepository $cacheRepository;

    public function __construct(CacheRepository $cacheRepository) {
        $this->cacheRepository = $cacheRepository;
    }

    public function getUser(int $id): UserResponseDto
    {
        $cacheKey = "user_{$id}";

        return $this->cacheRepository->remember($cacheKey, self::CACHE_TTL_SECONDS, function () use ($id) {
            $response = Http::timeout(self::API_TIMEOUT_SECONDS)->get("https://jsonplaceholder.typicode.com/users/{$id}");

            if ($response->failed()) {
                abort(502, 'Failed to fetch user data from external API');
            }

            return UserTransformer::fromApiResponse($response->json());
        });
    }
}
