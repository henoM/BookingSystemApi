<?php

namespace App\Repositories\Contracts;

use Illuminate\Support\Collection;
use App\Models\Booking;

interface BookingRepositoryInterface
{
    public function create(array $data): Booking;
    public function find(int $id): ?Booking;
    public function delete(int $id): bool;
    public function getByResourceId(int $resourceId): Collection;
} 