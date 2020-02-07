<?php

namespace SchGroup\SeventeenTrack\Exceptions;

use Throwable;

class SeventeenTrackMethodCallException extends \Exception
{
    /**
     * WeldPayMethodCallException constructor.
     * @param string $urlCall
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($urlCall = "", $message = "", $code = 0, Throwable $previous = null)
    {
        $message = "Exception in api method: " . $urlCall . " with Error code: " . $code . " with message: " . $message;
        parent::__construct($message, $code, $previous);
    }
}