<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;

/**
 * Class SeederCommand
 * @package App\Console\Commands
 */
class MakePay extends GeneratorCommand
{

    /**
     * @var string $signature
     */
    protected $signature = 'make:pay {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Pay class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Pay';


    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub(): string
    {
        $stub = base_path() . '/template/stubs/PayTpl.stub';
        return $stub;
    }

    /**
     * @param string $rootNamespace RootNamespace.
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace . '\Finance\Pay';
    }

    /**
     * 替换假类的内容
     * @param string $stub Stub.
     * @param string $name Name.
     * @return string
     */
    protected function replaceClass($stub, $name): string
    {
        $result = parent::replaceClass($stub, $name);
        return $result;
    }
}
