<?php

declare(strict_types=1);

use App\Controllers\UserController;
use App\Enums\HttpMethodEnum;

return [
    ['users/create',  [UserController::class, 'create'], HttpMethodEnum::GET],
    ['users/{id}',  [UserController::class, 'show'], HttpMethodEnum::GET],
    ['users',  [UserController::class, 'index'], HttpMethodEnum::GET],
    ['users',  [UserController::class, 'store'], HttpMethodEnum::POST],
    ['users/edit/{id}',  [UserController::class, 'edit'], HttpMethodEnum::GET],
    ['users/update/{id}',  [UserController::class, 'update'], HttpMethodEnum::POST],
    ['users/delete/{id}',  [UserController::class, 'destroy'], HttpMethodEnum::POST],
];
