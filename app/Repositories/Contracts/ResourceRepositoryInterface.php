<?php

namespace App\Repositories\Contracts;

use Illuminate\Support\Collection;
use App\Models\Resource;

interface ResourceRepositoryInterface
{
    public function all(): Collection;
    public function create(array $data): Resource;
    public function find(int $id): ?Resource;
} 