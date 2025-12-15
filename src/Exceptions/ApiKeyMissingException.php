<?php

declare(strict_types=1);

namespace Harvardartmuseums\HamAPI\Exceptions;

class ApiKeyMissingException extends HamApiException
{
    /**
     * Create a new exception instance.
     */
    public function __construct(string $message = 'No API key has been configured. Please set HAM_API_KEY in your .env file.')
    {
        parent::__construct($message);
    }
}