<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Resource;

class ResourceApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_resource()
    {
        $data = [
            'name' => 'Room 1',
            'type' => 'room',
            'description' => 'Test room',
        ];

        $response = $this->postJson('/api/resources', $data);
        if ($response->status() !== 201) {
            $response->dump();
        }
        $response->assertStatus(201)
                 ->assertJsonFragment(['name' => 'Room 1']);
        $this->assertDatabaseHas('resources', ['name' => 'Room 1']);
    }

    public function test_can_get_resources()
    {
        Resource::factory()->create(['name' => 'Room 2', 'type' => 'room']);
        $response = $this->getJson('/api/resources');
        $response->assertStatus(200)
                 ->assertJsonFragment(['name' => 'Room 2']);
    }
} 