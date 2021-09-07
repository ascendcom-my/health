<?php

namespace Bigmom\Health\Jobs;

use Bigmom\Health\Contracts\Checker;
use Bigmom\Health\Traits\IsHealthCheckJob;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class RunHealthCheck implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, IsHealthCheckJob;

    protected Checker $check;
    protected array $handlers;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Checker $check, array $handlers)
    {
        $this->check = $check;
        $this->handlers = $handlers;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $this->check->runHealthCheck();
            foreach ($this->handlers as $handle) {
                try {
                    (new $handle($this->check->getName()))->handleSuccess();
                } catch (Exception $e) {
                    //
                }
            }
        } catch (Exception $e) {
            foreach ($this->handlers as $handle) {
                try {
                    (new $handle($this->check->getName()))->handleException($e);
                } catch (Exception $e) {
                    //
                }
            }
        }
    }
}
