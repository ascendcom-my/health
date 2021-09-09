<?php

namespace Bigmom\Health\Commands;

use Bigmom\Health\Actions\QueueStack;
use Illuminate\Console\Command;

class RunHealthCheck extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'health:check {stack : The stack to run}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run health check';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $stackName = $this->argument('stack');

        (new QueueStack($stackName))->handle();

        $this->info('Job dispatched.');
        return 0;
    }
}
