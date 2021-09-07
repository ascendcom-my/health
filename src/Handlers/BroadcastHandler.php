<?php

namespace Bigmom\Health\Handlers;

use Bigmom\Health\Contracts\Handler;
use Bigmom\Health\Events\HealthCheckFailed;
use Bigmom\Health\Events\HealthCheckSuccessful;
use Exception;

class BroadcastHandler implements Handler
{
    /**
     * The name of the service handled.
     *
     * @var \Exception
     */
    protected $serviceName;

    public function __construct(string $serviceName)
    {
        $this->serviceName = $serviceName;
    }

    /**
     * Function run when service is deemed healthy.
     *
     * @return void
     */
    public function handleSuccess(): void
    {
        HealthCheckSuccessful::dispatch($this->serviceName);
    }

    /**
     * Function responsible for handling exception thrown.
     *
     * @return void
     */
    public function handleException(Exception $e): void
    {
        HealthCheckFailed::dispatch($this->serviceName, $e);
    }
}
