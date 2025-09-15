<?php

declare(strict_types=1);

namespace Celeris;

use Celeris\Router\RouterInterface;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class Kernel
{
    /**
     * The Kernel constructor.
     * It depends on the router and the DI container.
     *
     * @param RouterInterface $router The router instance.
     * @param ContainerInterface $container The DI container instance.
     * @param ResponseFactoryInterface $responseFactory A PSR-17 response factory.
     */
    public function __construct(
        private readonly RouterInterface $router,
        private readonly ContainerInterface $container,
        private readonly ResponseFactoryInterface $responseFactory
    ) {
    }

    /**
     * The main entry point for handling a request.
     *
     * @param ServerRequestInterface $request The incoming request.
     * @return ResponseInterface The resulting response.
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        // Use the router to dispatch the request based on its method and URI.
        $route = $this->router->dispatch($request->getMethod(), $request->getUri()->getPath());

        // Handle the router's response.
        switch ($route[0]) {
            case RouterInterface::NOT_FOUND:
                return $this->responseFactory->createResponse(404, 'Not Found');

            case RouterInterface::METHOD_NOT_ALLOWED:
                return $this->responseFactory->createResponse(405, 'Method Not Allowed');

            case RouterInterface::FOUND:
                $handler = $route[1]; // The controller/action to execute
                $vars = $route[2]; // Route parameters (e.g., /users/{id})

                $parameters = array_merge($vars, [$request]);

                return $this->container->call($handler, $parameters);
        }

        // Fallback for any unhandled case.
        return $this->responseFactory->createResponse(500, 'Internal Server Error');
    }
}