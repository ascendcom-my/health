<?php

namespace Bigmom\Health\Checks;

use Bigmom\Health\Checks\BaseCheck;
use Bigmom\Health\Contracts\Checker;
use Illuminate\Support\Facades\DB;

class DatabaseCheck extends BaseCheck implements Checker
{
    /**
     * The number of attempts the handle function should run before the service is deemed not healthy.
     * 
     * @var int
     */
    protected $attempts = 3;

    /**
     * The name of the service.
     *
     * @var string
     */
    protected $name = 'DatabaseCheck';

    /**
     * Function run to determine if the service is healthy or not.
     * Do not catch the exception that determines the health of the service.
     * The service is deemed to be healthy if no exceptions are thrown.
     *
     * @return void
     */
    public function handle(): void
    {
        DB::connection()->getPdo();
    }
}
