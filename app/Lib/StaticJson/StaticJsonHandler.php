<?php

namespace App\Lib\StaticJson;

use App\Lib\BaseCache;
use App\Models\Systems\StaticResource;

/**
 * Class StaticJsonHandler
 *
 * @package App\Lib
 */
class StaticJsonHandler
{
    use BaseCache;
    use StaticJsonLogic;
    use StaticJsonTableLogic;

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
        /** @var string $table_name */
        $table_name = null;
        /** @var string $jsonData */
        $jsonData = '';
        switch ($params['type']) {
            case StaticResource::TYPE_WHOLE_TABLE:
                $result = $this->handleTableData($params);
                extract($result, EXTR_OVERWRITE);
                break;
            case StaticResource::TYPE_COMMAND:
                $result = $this->handleCommandData();
                extract($result, EXTR_OVERWRITE);
                break;
            default:
                $jsonData = (string) json_encode($params['data'], JSON_UNESCAPED_UNICODE);
                break;
        }
        return $this->saveStaticRecord($params, $path, $jsonData, $table_name);
        //#######################################################
    }
}
