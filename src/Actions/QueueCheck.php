<?php

namespace Bigmom\Health\Actions;

use Bigmom\Health\Contracts\HealthCheckJob;

class QueueCheck
{
    protected array $checks;
    protected array $handlers;

    public function __construct(array $checks, array $handlers)
    {
        $this->checks = $checks;
        $this->handlers = $handlers;
    }

    public function handle()
    {
        foreach ($this->checks as $check) {
            $job = app()->make(HealthCheckJob::class, [new $check, $this->handlers]);
            $job->run();
        }
    }
}
