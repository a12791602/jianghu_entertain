<?php

namespace App\Lib\StaticJson;

use App\Lib\BaseCache;
use App\Models\Systems\StaticResource;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

/**
 * Class StaticJsonHandler
 *
 * @package App\Lib
 */
class StaticJsonHandler
{
    use BaseCache;
    use StaticJsonLogic;

    /**
     * @var string[]
     */
    private $saveField = [
                          'type',
                          'path',
                          'description',
                          'title',
                         ];

    /**
     * Setting Data into the Config
     * @return boolean
     * @throws \Exception Exception.
     * @param string $filename FileName.
     * @param array  $params   Params.
     * @var string $params [use_type] int 1 common , 2 individual
     * @var int $params [type] int, required 1 是普通数据的结果要存入为json 2 是表的结果要存入为 json  type 1 时不需要 table_name type 2 时需要 table_name
     * @var string $params [title] string, required           use_type 1|2  type 1|2 英文字母大小写.
     * @var string $params [description] string, required     use_type 1|2  type 1|2 中文备注.
     * @var string $params [table] string, required           use_type 1|2  type 2   表名存入.
     * @var string $params [fields] string, required          use_type 1|2  type 2   表名中要存入 json 的字段 比如 id,name,code,status
     * @var string $params [platform_sign] string, required   use_type 2.
     * @var string $params [path] string, required            use_type 1|2  type 1|2 存文件路径.
     * @var string $params [data] array, required             use_type 1|2  type 1 时 传入的数据 最终需要转变为 json.
     */
    public function setData(string $filename, array $params): bool
    {
        $params = $this->validateData($params);
        $path   = $params['path'] . '/' . $filename . '.json';
        if ($params['type'] === 2) {
            $result = $this->handleTableData($params);
            /** @var string $table_name */
            $table_name = null;
            /** @var string $jsonData */
            $jsonData = null;
            extract($result, EXTR_OVERWRITE);
            $filterCriteria = ['table_name' => $table_name];

            $staticResourceData               = Arr::only($params, $this->saveField);
            $staticResourceData['table_name'] = $table_name;
        } else {
            $jsonData = json_encode($params['data'], JSON_UNESCAPED_UNICODE);
        }
        $staticResourceData['path']        = $path;//覆盖之前的 路径与 拼接后缀的 路径
        $staticResourceData['static_type'] = StaticResource::STATIC_TYPE_JSON;

        Storage::disk('json')->put($path, (string) $jsonData);
        $storageLink = Storage::disk('json')->url($path);
        $this->cachingData($params, $path, $storageLink);
        $filterCriteria['type']        = $params['type'];
        $filterCriteria['title']       = $params['title'];
        $filterCriteria['static_type'] = StaticResource::STATIC_TYPE_JSON;
        $result                        = StaticResource::filter($filterCriteria)->first();
        if (! $result instanceof StaticResource) {
            $staticResourceEloq = new StaticResource();
            $staticResourceEloq->fill($staticResourceData);
            $result = $staticResourceEloq->save();
        } else {
            $params['path']     = $path;
            $staticResourceEloq = prepareBeforeSave($result, $params, $this->saveField);
            $result             = $staticResourceEloq->save();
        }
        return $result;
    }
}
