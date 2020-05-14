<?php

namespace App\Jobs\Statics;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

/**
 * Class StaticJson
 * @package App\Jobs\Statics
 */
class StaticJsonJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * Params.
     * @var array
     */
    private $data;

    /**
     * FileName.
     * @var string
     */
    private $staticKey;

    /**
     * Create a new job instance.
     * @param string $staticKey FileName.
     * @param array  $data      Params.
     * @var string $params [use_type] int 1 common , 2 individual
     * @var int $params [type] int, required 1 是普通数据的结果要存入为json 2 是表的结果要存入为 json  type 1 时不需要 table_name type 2 时需要 table_name
     * @var string $params [title] string, required           use_type 1|2  type 1|2 英文字母大小写.
     * @var string $params [description] string, required     use_type 1|2  type 1|2 中文备注.
     * @var string $params [table] string, required           use_type 1|2  type 2   表名存入.
     * @var string $params [fields] string, required          use_type 1|2  type 2   表名中要存入 json 的字段 比如 id,name,code,status
     * @var string $params [platform_sign] string, required   use_type 2.
     * @var string $params [path] string, required            use_type 1|2  type 1|2 存文件路径.
     * @var string $params [data] array, required             use_type 1|2  type 1 时 传入的数据 最终需要转变为 json.
     * @return void
     */
    public function __construct(string $staticKey, array $data)
    {
        $this->staticKey = $staticKey;
        $this->data      = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        genStaticJSON($this->staticKey, $this->data);
    }
}
