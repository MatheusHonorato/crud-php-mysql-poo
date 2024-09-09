<?php

declare(strict_types=1);

namespace App\Http;

class Helper
{
    public static function castingParams(array &$params): void
    {
        foreach ($params as $key => $param) {
            if (is_numeric($param)) {
                $params[$key] = (strpos($param, '.') === false) ? (int) $param : (float) $param;
            }
        }
    }


    public static function match(string $subject, string $path): array|bool
    {
        if($subject === '/' . $path) {
            return [];
        }

        $pattern = "/" . preg_replace('/\{[^\}]+\}/', '([^/]+)', $path);

        if(preg_match('#^' . $pattern . '$#', $subject, $matches)) {
            array_shift($matches);

            return $matches ?: false;
        }

        return false;
    }
}
