<?php

namespace Bigmom\Health\Commands;

use Illuminate\Console\GeneratorCommand;

class HealthHandlerMakeCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:health-handler';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new health handler class.';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Health handler';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        $stub = '/stubs/handler.stub';

        return $this->resolveStubPath($stub);
    }

    /**
     * Resolve the fully-qualified path to the stub.
     *
     * @param  string  $stub
     * @return string
     */
    protected function resolveStubPath($stub)
    {
        return file_exists($customPath = $this->laravel->basePath(trim($stub, '/')))
                        ? $customPath
                        : __DIR__.$stub;
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Health\Handlers';
    }
}
