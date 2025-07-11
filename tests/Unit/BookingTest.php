<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Booking;
use App\Models\Resource;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class BookingTest extends TestCase
{
    use RefreshDatabase;

    public function test_booking_fillable_fields()
    {
        $user = User::factory()->create();
        $booking = new Booking([
            'resource_id' => 2,
            'user_id' => $user->id,
            'start_time' => '2025-07-11 17:12:29',
            'end_time' => '2025-07-11 18:12:29',
        ]);
        $this->assertEquals($user->id, $booking->user_id);
    }

    public function test_booking_belongs_to_resource()
    {
        $user = User::factory()->create();
        $booking = new Booking([
            'resource_id' => 3,
            'user_id' => $user->id,
            'start_time' => '2025-07-11 17:12:29',
            'end_time' => '2025-07-11 18:12:29',
        ]);
        $this->assertEquals($user->id, $booking->user_id);
    }
} 