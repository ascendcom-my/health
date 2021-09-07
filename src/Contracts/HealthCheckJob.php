<?php

namespace Bigmom\Health\Contracts;

use Bigmom\Health\Traits\IsHealthCheckJob;
use Illuminate\Contracts\Queue\ShouldQueue;

interface HealthCheckJob extends ShouldQueue, IsHealthCheckJob
{
    public function __construct(Checker $check, array $handlers);
}
