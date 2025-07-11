<?php

namespace App\Repositories;

use App\Models\Resource;
use App\Repositories\Contracts\ResourceRepositoryInterface;
use Illuminate\Support\Collection;

class ResourceRepository implements ResourceRepositoryInterface
{
    public function all(): Collection
    {
        return Resource::all();
    }

    public function create(array $data): Resource
    {
        return Resource::create($data);
    }

    public function find(int $id): ?Resource
    {
        return Resource::find($id);
    }
} 