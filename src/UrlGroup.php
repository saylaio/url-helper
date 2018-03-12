<?php

namespace Sayla\Helper\Url;

use Sayla\Helper\Data\ArrayObject;

class UrlGroup extends ArrayObject
{
    /** @var Builder */
    private static $defaultResolverFactory;
    /** @var Builder */
    private $resolvers;

    /**
     * UrlBuilder constructor.
     * @param Builder $resolvers
     */
    public function __construct(Builder $resolvers, array $aliases = [])
    {
        $this->resolvers = $resolvers;
        parent::__construct($aliases);
    }

    public static function make(): UrlGroup
    {
        return new UrlGroup(self::getDefaultResolverFactory());
    }

    /**
     * @return Builder
     */
    public static function getDefaultResolverFactory(): Builder
    {
        return self::$defaultResolverFactory;
    }

    /**
     * @param Builder $defaultResolverFactory
     */
    public static function setDefaultResolverFactory(Builder $defaultResolverFactory): void
    {
        self::$defaultResolverFactory = $defaultResolverFactory;
    }

    /**
     * @param $name
     * @return string
     */
    public function __get($name)
    {
        return (string)$this->url($name);
    }

    /**
     * @param  $name
     * @param array $args
     * @return Url
     */
    public function url($name, $args = []): Url
    {
        return $this->resolvers->makeUrl($this->get($name, $args));
    }

    /**
     * @param $name
     * @param bool|null $absoluteUrl
     * @return null|string
     */
    public function get($name, $args = [], bool $absoluteUrl = null): ?string
    {
        if (isset($this[$name])) {
            return $this->resolvers->getRouteResolver()->resolve($this[$name], (array)$args, $absoluteUrl);
        }
        return $this->resolvers->getUrlResolver()->resolve($this[$name], (array)$args, $absoluteUrl);
    }
}

