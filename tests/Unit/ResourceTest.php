<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Resource;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ResourceTest extends TestCase
{
    use RefreshDatabase;

    public function test_resource_fillable_fields()
    {
        $data = [
            'name' => 'Test Room',
            'type' => 'room',
            'description' => 'desc'
        ];
        $resource = Resource::create($data);
        $this->assertEquals('Test Room', $resource->name);
        $this->assertEquals('room', $resource->type);
        $this->assertEquals('desc', $resource->description);
    }

    public function test_resource_has_many_bookings()
    {
        $resource = Resource::factory()->create();
        $this->assertTrue(method_exists($resource, 'bookings'));
    }
} 