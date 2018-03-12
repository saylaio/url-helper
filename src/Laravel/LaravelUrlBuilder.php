<?php

namespace Sayla\Helper\Url\Laravel;

use Sayla\Helper\Url\Builder;
use Sayla\Helper\Url\CallableUrlResolver;

class LaravelUrlBuilder extends Builder
{
    public function __construct()
    {
        parent::__construct(
            new CallableUrlResolver(function (string $urlIdentifier, array $parts, ?bool $absolute) {
                return url($urlIdentifier, $parts, $absolute ?? $this->isForceAbsoluteUrls());
            }),
            new CallableUrlResolver(function (string $urlIdentifier, array $parts, ?bool $absolute) {
                if (strpos($urlIdentifier, '@') !== false) {
                    return action($urlIdentifier, $parts, $absolute ?? $this->isForceAbsoluteUrls());
                }
                return route($urlIdentifier, $parts, $absolute ?? $this->isForceAbsoluteUrls());
            })
        );
    }

    public function makeUrl(string $url)
    {
        return new LaravelUrl($url, false);
    }

}

