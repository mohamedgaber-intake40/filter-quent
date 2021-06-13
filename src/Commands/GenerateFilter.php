<?php

namespace Filter\Commands;

use Illuminate\Console\GeneratorCommand;

class GenerateFilter extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:filter {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Filter';


    protected function getStub()
    {
        return __DIR__ . '/../stubs/filter.stub';
    }

    protected function buildClass($name)
    {
        return parent::buildClass($name);
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Filters';
    }


}
