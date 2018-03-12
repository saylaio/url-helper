<?php

namespace Sayla\Helper\Url\Laravel;

use Sayla\Helper\Url\Url;

class LaravelUrl extends Url
{
    /**
     * @param string $key
     * @return mixed|string
     */
    public function getQuery($key = null)
    {
        if (is_null($key)) {
            return $this->query;
        }
        return array_get($this->query, $key);
    }

    /**
     * @param string|array $key
     * @param mixed $value
     * @return $this
     */
    public function query($key, $value = null)
    {
        $clone = clone $this;
        if (is_array($key)) {
            $clone->query = array_merge($clone->query, $key);
        } else {
            array_set($clone->query, $key, $value);
        }
        return $clone;
    }
}

