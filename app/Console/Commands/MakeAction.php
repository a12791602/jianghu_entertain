<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;

/**
 * Class MakeAction
 * @package App\Console\Commands
 */
class MakeAction extends GeneratorCommand
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:action {name} {--r}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '生成Action --r 生成对应的Request文件';

    /**
     * @var string $type
     */
    protected $type = 'Action';
    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return base_path('template/stubs') . '/Action.stub';
    }

    /**
     * @param mixed $rootNamespace RootNamespace.
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace . '\Http\SingleActions';
    }

    /**
     * @return boolean|void|null
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException Exception.
     */
    public function handle()
    {
        if (!is_string($this->argument('name'))) {
            $this->error('命名不符合规范!');
            return false;
        }
        if (substr($this->argument('name'), -6) !== 'Action') {
            $this->error('Action 命名不符合规范!');
            return false;
        }
        if ($this->option('r')) {
            $this->_createRequest();
        }
        return parent::handle();
    }

    /**
     * 创建request
     * @return boolean
     */
    private function _createRequest(): bool
    {
        if (!is_string($this->argument('name'))) {
            $this->error('命名不符合规范!');
            return false;
        }
        $this->call(
            'make:request',
            [
             'name' => substr($this->argument('name'), 0, -6) . 'Request',
            ],
        );
        return true;
    }
}
