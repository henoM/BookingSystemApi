<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Repositories\ResourceRepository;
use App\Models\Resource;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ResourceRepositoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_and_find_resource()
    {
        $repo = new ResourceRepository();
        $resource = $repo->create([
            'name' => 'Test',
            'type' => 'room',
            'description' => 'desc'
        ]);
        $this->assertInstanceOf(Resource::class, $resource);
        $this->assertEquals('Test', $repo->find($resource->id)->name);
    }
} 