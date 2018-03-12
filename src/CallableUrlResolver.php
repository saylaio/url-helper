<?php

namespace Sayla\Helper\Url;

class CallableUrlResolver implements UrlResolver
{
    /** @var callable */
    private $callback;

    /**
     * CallableUrlResolver constructor.
     * @param callable $callback
     */
    public function __construct(callable $callback)
    {
        $this->callback = $callback;
    }

    public function __invoke($urlIdentifier, $parts, $absolute)
    {
        return $this->resolve($urlIdentifier, $parts, $absolute);
    }

    /**
     * @param string $urlIdentifier
     * @param array $parts
     * @param bool $absolute
     * @return string
     */
    public function resolve(string $urlIdentifier, array $parts, ?bool $absolute): string
    {
        return call_user_func($this->callback, $urlIdentifier, $parts, $absolute);
    }
}

