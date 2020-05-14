<?php

namespace App\Console\Commands\Statics;

use App\Console\Commands\BaseCommand;
use App\Jobs\Statics\StaticJsonJob;
use App\Models\Systems\StaticResource;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;

/**
 * Class GenerateStaticJson
 * @package App\Console\Commands\Statics
 */
class GenerateStaticJson extends BaseCommand
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:json {--index=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '生成Json 静态数据文件 --index 为 static_json 中的 index 可以单独执行某个命令';

    /**
     * 自定义字段 【此字段在数据库中没有的字段字典】
     * @var array<string,string>
     */
    protected $extraDefinition = ['index' => 'index from static_json'];


    /**
     * @return string[]
     */
    protected function rules(): array
    {
        return ['index' => 'alpha_dash|max:50'];
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $datas = Config::get('static_json.data');
        $index = $this->option('index');
        if ($index === null) {
            $datas        = Config::get('static_json.data');
            $filteredData = Arr::where(
                $datas,
                static function ($value) {
                    return $value['type'] === StaticResource::TYPE_WHOLE_TABLE;
                },
            );
            foreach ($filteredData as $staticKey => $data) {
                dispatch(new StaticJsonJob((string) $staticKey, $data));
            }
            $this->info('Success!');
        } else {
            if (is_string($index)) {
                if (array_key_exists($index, $datas)) {
                    $data = Arr::get($datas, $index);
                    dispatch(new StaticJsonJob($index, $data));
                    $this->info('Success!');
                } else {
                    $this->info('there has no key in the config!!!');
                }
            } else {
                $this->info('please put string!!!');
            }
        }//end if
    }
}
