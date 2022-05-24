<?php

namespace App\EventListener;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class RequestListener
{
    public function __construct(private string $systemToken)
    {
    }

    public function onKernelRequest(RequestEvent $event): void
    {
        $token = $this->getToken($event->getRequest());

        if ($token !== $this->systemToken) {
            throw new \Exception('Permission denied!');
        }
    }

    private function getToken(Request $request): ?string
    {
        return $request->query->get("token") ?? $request->headers->get('token');
    }
}
