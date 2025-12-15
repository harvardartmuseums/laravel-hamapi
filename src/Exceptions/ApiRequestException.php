<?php

declare(strict_types=1);

namespace Harvardartmuseums\HamAPI\Exceptions;

class ApiRequestException extends HamApiException
{
    private int $statusCode;
    private ?string $responseBody;

    /**
     * Create a new exception instance.
     */
    public function __construct(string $message, int $statusCode, ?string $responseBody = null)
    {
        $this->statusCode = $statusCode;
        $this->responseBody = $responseBody;

        parent::__construct($message, $statusCode);
    }

    /**
     * Get the HTTP status code.
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * Get the response body.
     */
    public function getResponseBody(): ?string
    {
        return $this->responseBody;
    }
}