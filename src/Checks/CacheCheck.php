<?php

namespace Bigmom\Health\Checks;

use Bigmom\Health\Checks\BaseCheck;
use Bigmom\Health\Contracts\Checker;
use Illuminate\Support\Facades\Cache;

class CacheCheck extends BaseCheck implements Checker
{
    /**
     * The number of attempts the handle function should run before the service is deemed not healthy.
     * 
     * @var int
     */
    protected $attempts = 1;

    /**
     * The name of the service.
     *
     * @var string
     */
    protected $name = 'CacheCheck';

    /**
     * Function run to determine if the service is healthy or not.
     * Do not catch the exception that determines the health of the service.
     * The service is deemed to be healthy if no exceptions are thrown.
     *
     * @return void
     */
    public function handle(): void
    {
        Cache::get('abc');
    }
}
