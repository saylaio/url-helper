<?php

namespace Sayla\Helper\Url;

class InvalidUrlException extends \RuntimeException
{
    public static $defaultCode = 500;

    public function __construct($url, $code = null, \Exception $previous = null)
    {
        $message = 'The specified URL is invalid: ' . $url;
        parent::__construct($message, $code ?? self::$defaultCode, $previous);
    }
}