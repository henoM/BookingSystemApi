<?php

namespace App\Repositories;

use App\Models\Booking;
use App\Repositories\Contracts\BookingRepositoryInterface;
use Illuminate\Support\Collection;

class BookingRepository implements BookingRepositoryInterface
{
    public function create(array $data): Booking
    {
        return Booking::create($data);
    }

    public function find(int $id): ?Booking
    {
        return Booking::find($id);
    }

    public function delete(int $id): bool
    {
        $booking = Booking::find($id);
        if ($booking) {
            return $booking->delete();
        }
        return false;
    }

    public function getByResourceId(int $resourceId): Collection
    {
        return Booking::where('resource_id', $resourceId)->get();
    }
} 