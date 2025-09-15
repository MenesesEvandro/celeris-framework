<?php

declare(strict_types=1);

namespace Celeris\Router;

use FastRoute\Dispatcher;
use FastRoute\RouteCollector;
use function FastRoute\simpleDispatcher;

class Router implements RouterInterface
{
    /**
     * @var RouteCollector
     */
    private RouteCollector $routeCollector;

    /**
     * The dispatcher instance.
     * @var Dispatcher
     */
    private Dispatcher $dispatcher;

    /**
     * Router constructor.
     *
     * @param callable $routeDefinitionCallback A function that defines the routes.
     */
    public function __construct(callable $routeDefinitionCallback)
    {
        // Create a dispatcher that uses a RouteCollector to define routes.
        $this->dispatcher = simpleDispatcher(function (RouteCollector $r) use ($routeDefinitionCallback) {
            $this->routeCollector = $r;

            $routeDefinitionCallback($this);
        });
    }

    /**
     * {@inheritDoc}
     */
    public function get(string $path, mixed $handler): void
    {
        $this->routeCollector->addRoute('GET', $path, $handler);
    }

    /**
     * {@inheritDoc}
     */
    public function dispatch(string $method, string $uri): array
    {
        // Use the underlying FastRoute dispatcher to find the route.
        $routeInfo = $this->dispatcher->dispatch($method, $uri);

        // Adapt the FastRoute result to the format defined by our RouterInterface.
        switch ($routeInfo[0]) {
            case Dispatcher::NOT_FOUND:
                return [self::NOT_FOUND, null, []];

            case Dispatcher::METHOD_NOT_ALLOWED:
                return [self::METHOD_NOT_ALLOWED, null, []];

            case Dispatcher::FOUND:
                $handler = $routeInfo[1];
                $vars = $routeInfo[2];
                return [self::FOUND, $handler, $vars];
        }

        // This should never be reached.
        throw new \LogicException('An unexpected dispatch result was received.');
    }
}