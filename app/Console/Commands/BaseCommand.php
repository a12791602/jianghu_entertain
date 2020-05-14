<?php

namespace App\Console\Commands;

use Cerbero\CommandValidator\ValidatesInput;
use Illuminate\Console\Command;

/**
 * Class BaseCommand
 * @package App\Console\Commands
 */
class BaseCommand extends Command
{
    use ValidatesInput;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'base';

    /**
     * @var array 自定义字段 【此字段在数据库中没有的字段字典】
     */
    protected $extraDefinition = [];

    /**
     * @return string[]
     */
    protected function rules(): array
    {
        return [];
    }

    /**
     * Retrieve the custom attribute names for error messages
     *
     * @return array<string,string>
     */
    protected function attributes(): array
    {
        return $this->extraDefinition;
    }
}
