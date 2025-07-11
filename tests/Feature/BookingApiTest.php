<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Resource;
use App\Models\Booking;
use App\Models\User;

class BookingApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_booking()
    {
        $resource = Resource::factory()->create();
        $user = User::factory()->create();
        $data = [
            'resource_id' => $resource->id,
            'user_id' => $user->id,
            'start_time' => '2025-07-11 17:12:29',
            'end_time' => '2025-07-11 18:12:29',
        ];

        $response = $this->postJson('/api/bookings', $data);

        $response->assertStatus(201)
                 ->assertJsonFragment(['resource_id' => $resource->id]);
        $this->assertDatabaseHas('bookings', ['resource_id' => $resource->id]);
    }

    public function test_can_get_bookings_by_resource()
    {
        $resource = Resource::factory()->create();
        $user = User::factory()->create();
        $data = [
            'resource_id' => $resource->id,
            'user_id' => $user->id,
            'start_time' => '2025-07-11 17:12:29',
            'end_time' => '2025-07-11 18:12:29',
        ];
        $this->postJson('/api/bookings', $data);
        $response = $this->getJson("/api/resources/{$resource->id}/bookings");
        $response->assertStatus(200)
                 ->assertJsonStructure(['data' => [['id', 'resource_id', 'user_id', 'start_time', 'end_time']]]);
    }

    public function test_can_delete_booking()
    {
        $resource = Resource::factory()->create();
        $user = User::factory()->create();
        $data = [
            'resource_id' => $resource->id,
            'user_id' => $user->id,
            'start_time' => '2025-07-11 17:12:29',
            'end_time' => '2025-07-11 18:12:29',
        ];
        $booking = $this->postJson('/api/bookings', $data)->json('data');
        $response = $this->deleteJson("/api/bookings/{$booking['id']}");
        $response->assertStatus(204);
        $this->assertDatabaseMissing('bookings', ['id' => $booking['id']]);
    }
} 