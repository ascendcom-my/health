<?php

namespace Bigmom\Health\Traits;

trait IsHealthCheckJob
{
    public function run()
    {
        SELF::dispatch($this->check, $this->handlers);
    }
}
