<?php

declare(strict_types=1);

namespace Harvardartmuseums\HamAPI\Exceptions;

use Exception;

class HamApiException extends Exception
{
    /**
     * Create a new exception instance.
     */
    public function __construct(string $message = '', int $code = 0, ?Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}