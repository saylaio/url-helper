<?php

namespace Sayla\Helper\Url;

class Builder
{
    /** @var UrlResolver */
    private $urlResolver;
    /** @var UrlResolver */
    private $routeResolver;
    /** @var bool */
    private $forceAbsoluteUrls = true;

    /**
     * ResolverFactory constructor.
     * @param UrlResolver $urlResolver
     * @param UrlResolver $routeResolver
     */
    public function __construct(UrlResolver $urlResolver, UrlResolver $routeResolver = null)
    {
        $this->urlResolver = $urlResolver;
        $this->routeResolver = $routeResolver;
    }

    /**
     * @return UrlResolver
     */
    public function getRouteResolver(): UrlResolver
    {
        return $this->routeResolver;
    }

    /**
     * @param UrlResolver $routeResolver
     * @return Builder
     */
    public function setRouteResolver(UrlResolver $routeResolver): self
    {
        $this->routeResolver = $routeResolver;
        return $this;
    }

    /**
     * @return UrlResolver
     */
    public function getUrlResolver(): UrlResolver
    {
        return $this->urlResolver;
    }

    /**
     * @param UrlResolver $urlResolver
     * @return Builder
     */
    public function setUrlResolver(UrlResolver $urlResolver): self
    {
        $this->urlResolver = $urlResolver;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasRouteResolver(): bool
    {
        return isset($this->routeResolver);
    }

    /**
     * @return bool
     */
    public function isForceAbsoluteUrls(): bool
    {
        return $this->forceAbsoluteUrls;
    }

    /**
     * @param bool $forceAbsoluteUrls
     * @return Builder
     */
    public function setForceAbsoluteUrls(bool $forceAbsoluteUrls): self
    {
        $this->forceAbsoluteUrls = $forceAbsoluteUrls;
        return $this;
    }

    /**
     * @param string $url
     * @return Url
     */
    public function makeUrl(string $url)
    {
        return new Url($url, false);
    }
}

