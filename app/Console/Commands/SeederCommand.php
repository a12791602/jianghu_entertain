<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Composer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * Class SeederCommand
 * @package App\Console\Commands
 */
class SeederCommand extends GeneratorCommand
{

    /**
     * 上一次编辑的内容
     * @var string $content
     */
    protected $content;

    public const SPACE = ' ';

    /**
     * 最大执行条数
     * @var integer $maxLimit
     */
    protected $maxLimit = 10000;

    public const MODE_APPEND = 'append'; //附加模式
    public const MODE_COVER  = 'cover';  //覆盖模式

    /**
     * @var string $signature
     */
    protected $signature = 'make:seeder 
                                {name}
                                {--m=append}
                                {--c=}
                                {--f=}
                                {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new seeder class
    {name:This is the seeder name, which corresponds to your own model name}
    {--c=:This is the ID of the data to be inserted,for example --c=1,2,3}
    {--f=:This is the column name of the data to be inserted,for example --f=id,name,email}
    {--m=cover:This is the data update mode. Cover means to overwrite the original data,
               and append means to append data to the original data.
               --force:Delegate to enforce.}';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Seeder';

    /**
     * The Composer instance.
     *
     * @var Composer
     */
    protected $composer;

    /**
     * Create a new command instance.
     *
     * @param  Filesystem $files    Files.
     * @param  Composer   $composer Composer.
     * @return void
     */
    public function __construct(Filesystem $files, Composer $composer)
    {
        parent::__construct($files);

        $this->composer = $composer;
    }

    /**
     * @return boolean
     * @throws \Exception Exception.
     */
    public function handle(): bool
    {
        parent::handle();
        $this->composer->dumpAutoloads();
        return true;
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub(): string
    {
        $stub = base_path() . '/template/stubs/seeder.stub';
        return $stub;
    }

    /**
     * Get the destination class path.
     *
     * @param  string $name Name.
     * @return string
     */
    protected function getPath($name): string
    {
        $name = ucfirst($name) . 'Seeder';
        $path = $this->laravel->databasePath() . '/seeds/' . $name . '.php';
        return $path;
    }

    /**
     * Determine if the class already exists.
     *
     * @param string $rawName RawName.
     * @return boolean
     * @throws \Exception Exception.
     */
    protected function alreadyExists($rawName): bool
    {
        $filePath = $this->getPath($this->qualifyClass($rawName));
        $file     = $this->files->exists($filePath);
        if ($file) {
            $mode = $this->option('m');
            $mode = strtolower($mode);
            if ($mode === self::MODE_APPEND) {
                $content       = $this->files->get($filePath);
                $header        = $this->_getHeader();
                $footer        = $this->_getFooter();
                $indexStart    = strpos($content, $header);
                $headerLen     = strlen($header);
                $indexEnd      = strrpos($content, $footer);
                $strStart      = $indexStart + $headerLen;
                $strEnd        = $indexEnd - ($indexStart + $headerLen);
                $content       = substr($content, $strStart, $strEnd);
                $this->content = $content;
            }
        }
        return false;
    }

    /**
     * 自定义名称
     * Parse the class name and format according to the root namespace.
     *
     * @param string $name Name.
     * @return string
     */
    protected function qualifyClass($name): string
    {
        $result = ucfirst($name);
        return $result;
    }

    /**
     * 替换假类的内容
     * @param string $stub Stub.
     * @param string $name Name.
     * @return string
     */
    protected function replaceClass($stub, $name): string
    {
        $stub   = $this->replaceCustomizeSetting($stub); //替换自定义内容
        $result = parent::replaceClass($stub, $name);
        return $result;
    }

    /**
     * 替换自定义内容
     * @param string $stub Stub.
     * @return string
     */
    protected function replaceCustomizeSetting(string $stub): string
    {
        $content = $this->_getReplaceContent(); //得到要替换的内容
        $stub    = Str::replaceLast('~CUSTOMIZE~', $content, $stub);
        return $stub;
    }

    /**
     * 得到要替换的内容
     * @return string
     */
    private function _getReplaceContent(): string
    {
        $seederName = $this->argument('name');
        $tableName  = $this->_getTable($seederName);
        $condition  = $this->option('c');
        $feild      = $this->option('f');
        $model      = DB::table($tableName);
        if (!empty($feild)) {
            $feild = explode(',', $feild);
            $model = $model->select($feild);
        }
        if (!empty($condition)) {
            $condition = explode(',', $condition);
            $model     = $model->whereIn('id', $condition);
        }
        try {
            $data = $model->get()->toJson();
        } catch (\Throwable $exception) {
            $message = $exception->getMessage();
            $this->error($message);
            die(0);
        }
        $data   = \json_decode($data, true);
        $number = count($data);
        $force  = $this->option('force');
        if ($number > $this->maxLimit && !$force) {
            $flag = $this->confirm(
                'Data is greater than the maximum number of ' .
                $this->maxLimit . '. Are you sure to continue to generate Seeder?[y|N]',
            );
            if (!$flag) {
                $this->error('Canceled generation of Seeder!');
                die(0);
            }
        }
        if ($number > 0) {
            $data = $this->_arrToStr($data); //格式格式化字符串
        } else {
            $data = '';
        }
        return $data;
    }

    /**
     * 获取表名
     * @param string $seederName SeederName.
     * @return string
     */
    private function _getTable(string $seederName): string
    {
        $tableName  = Str::snake($seederName);
        $lastLetter = Str::substr($tableName, -1);
        if ($lastLetter === 'y') {
            $tableName = Str::replaceLast('y', 'ies', $tableName);
        } else {
            $tableName .= 's';
        }
        return $tableName;
    }

    /**
     * 格式化
     * @param array $array Array.
     * @return string
     */
    private function _arrToStr(array $array): string
    {
        $thirteen = str_pad('', 13, self::SPACE);
        $fourteen = str_pad('', 14, self::SPACE);
        $header   = $this->_getHeader();
        $footer   = $this->_getFooter();
        $string   = '';
        $content  = '';
        $string  .= $header;
        foreach ($array as $item) {
            $content  .= $thirteen . '[' . PHP_EOL;
            $maxLength = $this->_getMaxLength($item);
            foreach ($item as $ikey => $value) {
                $spaceNum = $maxLength - strlen($ikey);
                $space    = str_pad('', $spaceNum, self::SPACE);
                if (is_string($value)) {
                    $value    = "'" . $value . "'";
                    $content .= $fourteen . "'" . $ikey . "'" . $space . ' => ' . $value . ',' . PHP_EOL;
                } elseif ($value === null) {
                    $content .= $fourteen . "'" . $ikey . "'" . $space . ' => null,' . PHP_EOL;
                } elseif (is_numeric($value)) {
                    $content .= $fourteen . "'" . $ikey . "'" . $space . ' => ' . $value . ',' . PHP_EOL;
                } else {
                    $content .= $fourteen . "'" . $ikey . "'" . $space . ' => ' . $value . ',' . PHP_EOL;
                }
            }
            $content .= $thirteen . '],' . PHP_EOL;
        }
        $mode = $this->option('m');
        $mode = strtolower($mode);
        if ($mode === self::MODE_APPEND) {
            $string .= $this->content;
        }
        $string .= $content;
        $string .= $footer;
        return $string;
    }

    /**
     * 得到字符串的头部
     * @return string
     */
    private function _getHeader(): string
    {
        $twelve = str_pad('', 12, self::SPACE);
        return $twelve . '[' . PHP_EOL;
    }

    /**
     * 得到字符串的尾部
     * @return string
     */
    private function _getFooter(): string
    {
        $twelve = str_pad('', 12, self::SPACE);
        return $twelve . '],';
    }

    /**
     * 获取数组最长键的长度值.
     *
     * @param mixed[] $data 数据.
     * @return integer
     */
    private function _getMaxLength(array $data): int
    {
        $keys    = array_keys($data);
        $numbers = [];
        foreach ($keys as $item) {
            $numbers[] = strlen($item);
        }
        rsort($numbers);
        $maxLength = $numbers[0] ?? 0;
        return $maxLength;
    }
}
