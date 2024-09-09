<?php

declare(strict_types=1);

namespace App\Repositories;

use App\DB\DBConnection;
use App\Models\User;

class UserRepositoryPDO implements UserRepositoryInterface
{
    private \PDO $pdo;

    public function __construct(
    ) {
        $this->pdo = (new DBConnection())->getInstance();
    }

    public function list(): array
    {
        try {
            $sql = "SELECT id, name, email FROM users";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();

            $users = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            if(count($users) > 0) {
                $users = array_map(fn ($user) => new User(...$user), $users);
            }

            return $users;
        } catch (\Exception $e) {
            throw $e;
        }

    }

    public function find(int $id): User
    {
        try {
            $sql = "SELECT id, name, email FROM users WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            $user = $stmt->fetch(\PDO::FETCH_ASSOC);

            if ($user == false) {
                throw new \Exception('User not found');
            }

            return new User(...$user);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function save(User $user): void
    {
        try {
            $sql = "INSERT INTO users (name, email) VALUES (:name, :email)";

            $this->pdo->beginTransaction();

            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':name', $user->name);
            $stmt->bindValue(':email', $user->email);
            $stmt->execute();

            $this->pdo->commit();
        } catch (\Exception $e) {
            $this->pdo->rollBack();

            throw $e;
        }
    }

    public function update(User $user): void
    {
        try {
            $sql = "UPDATE users SET name = :name WHERE id = :id";

            $this->pdo->beginTransaction();

            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':id', $user->id);
            $stmt->bindValue(':name', $user->name);
            $stmt->bindValue(':email', $user->email);
            $stmt->execute();

            $this->pdo->commit();
        } catch (\Exception $e) {
            $this->pdo->rollBack();

            throw $e;
        }
    }

    public function delete(int $id): void
    {
        try {
            $this->find($id);

            $sql = "DELETE FROM users WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();

        } catch (\Exception $e) {
            throw $e;
        }
    }
}
