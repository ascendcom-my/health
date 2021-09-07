<?php

namespace Bigmom\Health\Checks;

use Exception;

abstract class BaseCheck
{
    protected $attempts = 1;

    protected $name;

    abstract protected function handle(): void;

    public function runHealthCheck(): void
    {
        for ($currentAttempt = 1; $currentAttempt <= $this->attempts; $currentAttempt++) {
            try {
                $this->handle();
            } catch (Exception $e) {
                if ($currentAttempt === $this->attempts) {
                   throw $e; 
                }
            }
        }
    }

    public function getName(): string
    {
        return $this->name;
    }
}
