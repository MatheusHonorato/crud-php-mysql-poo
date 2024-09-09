<?php

declare(strict_types=1);

namespace App\Http;

use App\Enums\HttpMethodEnum;

interface RequestInterface
{
    public static function getBaseUrl(): string;

    public static function getUri(): string;

    public static function getHttpMethod(): HttpMethodEnum;

    public static function getQueryParams(): array;

    public static function getBody(): array|false;
}
