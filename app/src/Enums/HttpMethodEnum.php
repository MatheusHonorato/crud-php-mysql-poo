<?php

declare(strict_types=1);

namespace App\Enums;

enum HttpMethodEnum: string
{
    case GET = 'GET';
    case POST = 'POST';
    case PUT = 'PUT';
    case PATCH = 'PATCH';
    case DELETE = 'DELETE';
    case OPTIONS = 'OPTIONS';
    case HEAD = 'HEAD';
    case TRACE = 'TRACE';
    case CONNECT = 'CONNECT';

    public static function fromValue(string $value): self
    {
        return match ($value) {
            'GET' => self::GET,
            'POST' => self::POST,
            'PUT' => self::PUT,
            'PATCH' => self::PATCH,
            'DELETE' => self::DELETE,
            'OPTIONS' => self::OPTIONS,
            'HEAD' => self::HEAD,
            'TRACE' => self::TRACE,
            'CONNECT' => self::CONNECT,
        };
    }
}
