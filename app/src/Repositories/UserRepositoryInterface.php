<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\User;

interface UserRepositoryInterface
{
    public function list(): array;

    public function find(int $id): User;

    public function save(User $user): void;

    public function update(User $user): void;

    public function delete(int $id): void;
}
