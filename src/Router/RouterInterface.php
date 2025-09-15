<?php

declare(strict_types=1);

namespace Celeris\Router;

interface RouterInterface
{
    // Constants to represent the result of a dispatch.
    public const NOT_FOUND = 0;
    public const FOUND = 1;
    public const METHOD_NOT_ALLOWED = 2;

    /**
     * Register a GET route.
     *
     * @param string $path The URL path.
     * @param mixed $handler The handler to execute (e.g., [Controller::class, 'method']).
     */
    public function get(string $path, mixed $handler): void;

    /**
     * Dispatches a request against the registered routes.
     *
     * @param string $method The HTTP method of the request.
     * @param string $uri The URI of the request.
     * @return array Returns an array with the dispatch status, handler, and any route variables.
     */
    public function dispatch(string $method, string $uri): array;
}