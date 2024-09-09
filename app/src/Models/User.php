<?php

declare(strict_types=1);

namespace App\Models;

class User
{
    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly ?int $id = null
    ) {
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            throw new \Exception('Invalid E-mail');
        }
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email
        ];
    }
}
