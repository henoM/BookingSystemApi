<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Repositories\BookingRepository;
use App\Models\Booking;
use App\Models\Resource;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class BookingRepositoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_and_delete_booking()
    {
        $user = User::factory()->create();
        $resource = Resource::factory()->create();
        $repo = new BookingRepository();
        $booking = $repo->create([
            'resource_id' => $resource->id,
            'user_id' => $user->id,
            'start_time' => '2025-07-11 17:12:29',
            'end_time' => '2025-07-11 18:12:29',
        ]);
        $this->assertEquals($user->id, $booking->user_id);
        $this->assertTrue($repo->delete($booking->id));
    }
} 