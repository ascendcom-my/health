<?php

namespace Bigmom\Health\Actions;

use Exception;

class QueueStack
{
    protected string $stackName;
    protected array $checks;
    protected array $handlers;

    public function __construct(string $stackName)
    {
        $stack = config("health.stacks.{$stackName}");

        $this->stackName = $stackName;
        $this->checks = $this->resolveElement($stack, 'checks');
        $this->handlers = $this->resolveElement($stack, 'handlers');
    }

    public function handle()
    {
        (new QueueCheck($this->checks, $this->handlers))->handle();
    }

    protected function resolveElement(array $stack, string $element)
    {
        $result = $stack[$element];
        
        if (! is_array($result)) {
            throw new Exception("{$element} is not array in stack {$this->stackName}.");
        }

        return $result;
    }
}
