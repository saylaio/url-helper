<?php

namespace Sayla\Helper\Url;

interface UrlResolver
{
    /**
     * @param string $urlIdentifier
     * @param array $parts
     * @param bool $absolute
     * @return string
     */
    public function resolve(string $urlIdentifier, array $parts, ?bool $absolute): string;
}

