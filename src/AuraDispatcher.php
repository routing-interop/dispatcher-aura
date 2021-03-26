<?php

namespace Interop\Routing\Aura;

use Aura\Router\Matcher;
use Interop\Routing\DispatcherInterface;
use Interop\Routing\Route\RouteCollection;
use Psr\Http\Message\ServerRequestInterface;

final class AuraDispatcher implements DispatcherInterface
{
    private Matcher $matcher;

    public function __construct(Matcher $matcher)
    {
        $this->matcher = $matcher;
    }

    public function addRoutes(RouteCollection $routes): self
    {
        foreach ($routes as $route) {
            foreach ($route->getMethods() as $method) {
                $this->matcher->$method($route->getName(), $route->getPath());
            }
        }

        return $this;
    }

    public function dispatch(ServerRequestInterface $request): callable
    {
        return $this->matcher->match($request)->handler;
    }
}
