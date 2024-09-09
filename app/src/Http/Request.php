<?php

declare(strict_types=1);

namespace App\Http;

use App\Enums\HttpMethodEnum;
use App\Http\RequestInterface;

class Request implements RequestInterface
{
    public static function getBaseUrl(): string
    {
        $protocol = 'http';

        if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
            $protocol = 'https';
        }

        return "$protocol://" . $_SERVER['HTTP_HOST'];
    }

    public static function getUri(): string
    {
        return strtok($_SERVER['REQUEST_URI'], '?');
    }

    public static function getHttpMethod(): HttpMethodEnum
    {
        return HttpMethodEnum::fromValue($_SERVER['REQUEST_METHOD']);
    }

    public static function getQueryParams(): array
    {
        return $_GET;
    }

    public static function getBody(): array|false
    {
        parse_str(file_get_contents('php://input'), $data);

        return $data;
    }
}
