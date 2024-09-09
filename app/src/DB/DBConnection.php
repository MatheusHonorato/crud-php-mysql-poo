<?php

declare(strict_types=1);

namespace App\DB;

class DBConnection
{
    private static \PDO $instance;

    private static string $host = "db";

    private static string $user = "user";

    private static string $password = "password";

    private static string $db = "app";

    public function __construct()
    {
        if(!isset(self::$instance)) {
            $this->connect();
        }
    }

    private function connect(): void
    {
        self::$instance = new \PDO("mysql:host=".self::$host.";dbname=".self::$db, self::$user, self::$password);
    }

    public function getInstance(): \PDO
    {
        return self::$instance;
    }
}
