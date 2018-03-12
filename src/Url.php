<?php

namespace Sayla\Helper\Url;

class Url
{
    /** @var string */
    protected $fragment;
    /** @var string[] */
    protected $query = [];
    /** @var string */
    private $host;
    /** @var string */
    private $pass;
    /** @var string */
    private $path;
    /** @var string */
    private $port;
    /** @var string */
    private $scheme;
    /** @var string */
    private $user;

    public function __construct($url = null, $validate = true)
    {
        if (isset($url)) {
            if (!filter_var($url, FILTER_VALIDATE_URL, [FILTER_FLAG_HOST_REQUIRED])) {
                if ($validate) {
                    throw new InvalidUrlException($url);
                }
                $this->path = $url;
            } else {
                foreach (parse_url($url) as $part => $value) {
                    if ($part == 'query') {
                        parse_str($value, $this->query);
                    } else {
                        $this->{$part} = $value;
                    }
                }
            }
        }
    }

    public function __toString()
    {
        return $this->toString();
    }

    /**
     * @return string
     */
    public function toString()
    {
        $scheme = isset($this->scheme) ? $this->scheme . '://' : '';
        $port = isset($this->port) ? ':' . $this->port : '';
        $user = isset($this->user) ? $this->user : '';
        $pass = isset($this->pass) ? ':' . $this->pass : '';
        $pass = ($user || $pass) ? "$pass@" : '';
        $query = !empty($this->query) ? '?' . http_build_query($this->query) : '';
        $fragment = isset($this->fragment) ? '#' . $this->fragment : '';
        return $scheme
            . $this->user
            . $pass
            . $this->host
            . $port
            . $this->path
            . $query
            . $fragment;
    }

    /**
     * @return string
     */
    public function getFragment()
    {
        return $this->fragment;
    }

    /**
     * @return string
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @return string
     */
    public function getPass()
    {
        return $this->pass;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @return string
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * @param string $key
     * @return mixed|string
     */
    public function getQuery($key = null)
    {
        if (is_null($key)) {
            return $this->query;
        }
        return $this->query[$key] ?? null;
    }

    /**
     * @return string
     */
    public function getRelativePath()
    {
        return ltrim($this->path, '\/');
    }

    /**
     * @return string
     */
    public function getScheme()
    {
        return $this->scheme;
    }

    /**
     * @return string
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param string $host
     * @return $this
     */
    public function host($host)
    {
        $this->host = $host;
        return $this;
    }

    /**
     * @param string $path
     * @return $this
     */
    public function path($path)
    {
        $this->path = $path;
        return $this;
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
            $clone->query[$key] = $value;
        }
        return $clone;
    }

    /**
     * @param string $scheme
     * @return $this
     */
    public function scheme($scheme)
    {
        $this->scheme = $scheme;
        return $this;
    }

    /**
     * @param array|string ...$path
     * @return $this
     */
    public function segment(...$path)
    {
        $clone = clone $this;
        $clone->path .= '/' . join('/', $path);
        return $clone;
    }
}

