<?php

declare(strict_types=1);

namespace App\Controllers;

abstract class AbstractController
{
    public function view(string $view, array $data = []): void
    {
        extract($data);

        include_once ROOT.'src'.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.$view.'.php';
    }
}
