<?php

declare(strict_types=1);

namespace App\Http;

use App\Enums\HttpMethodEnum;
use App\Http\Helper;
use ReflectionMethod;
use App\Http\Request;
use Exception;

class Router
{
    private const PATH = 0;
    private const ACTION = 1;
    private const HTTP_METHOD = 2;
    private const CONTROLLER_NAME = 0;
    private const NAME = 1;

    public static function run(array $routes): void
    {
        foreach ($routes as $route) {
            if(!self::isMatchingRequest($route[self::HTTP_METHOD])) {
                continue;
            }

            $controller = self::instantiateController($route[self::ACTION][self::CONTROLLER_NAME]);

            $methodName = $route[self::ACTION][self::NAME];

            if (!$controller || !method_exists($controller, $methodName)) {
                continue;
            }

            $params = self::resolveParameters($route);

            if($params === false) {
                continue;
            }

            $controller->{$methodName}(...$params);

            return;
        }

        throw new Exception('Not found', 404);
    }

    private static function isMatchingRequest(HttpMethodEnum $routeMethod): bool
    {
        return Request::getHttpMethod() === $routeMethod;
    }

    private static function instantiateController(string $controller): ?object
    {
        return class_exists($controller) ? new $controller(new Request()) : null;
    }

    private static function resolveParameters(array $route): array|bool
    {
        $methodName = $route[self::ACTION][self::NAME];
        $controllerName = $route[self::ACTION][self::CONTROLLER_NAME];
        $expectedParamsCount = (new ReflectionMethod($controllerName, $methodName))->getNumberOfParameters();

        $params = Helper::match(Request::getUri(), $route[self::PATH]);

        if($params === false) {
            return false;
        }

        if($expectedParamsCount > 0) {
            Helper::castingParams($params);
        }

        return $params;
    }
}
