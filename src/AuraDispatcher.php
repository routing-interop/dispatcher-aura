<?php

namespace Interop\Routing\Aura;

use Aura\Router\Matcher;
use Interop\Routing\DispatcherInterface;
use Psr\Http\Message\ServerRequestInterface;

final class AuraDispatcher implements DispatcherInterface
{
    private Matcher $matcher;

    public function __construct(Matcher $matcher)
    {
        $this->matcher = $matcher;
    }

    public function dispatch(ServerRequestInterface $request): callable
    {
        return $this->matcher->match($request)->handler;
    }
}
