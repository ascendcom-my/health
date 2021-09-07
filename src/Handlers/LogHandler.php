<?php

namespace Bigmom\Health\Handlers;

use Bigmom\Health\Contracts\Handler;
use Exception;
use Illuminate\Support\Facades\Log;

class LogHandler implements Handler
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
        //
    }

    /**
     * Function responsible for handling exception thrown.
     *
     * @return void
     */
    public function handleException(Exception $e): void
    {
        Log::error($this->serviceName . " is not healthy. The exception encountered is:\n{$e->getMessage()}");
    }
}
