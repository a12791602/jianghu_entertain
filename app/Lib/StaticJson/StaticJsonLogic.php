<?php

namespace App\Lib\StaticJson;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Waavi\Sanitizer\Sanitizer;

trait StaticJsonLogic
{

    /**
     * @var string 公共json 存放两件地址
     */
    private $commonJsonLinterPath = 'common/linter.json';

    /**
     * @param array  $params      Params.
     * @param string $path        存文件路径.
     * @param string $storageLink 文件url.
     * @return boolean
     */
    protected function cachingData(array $params, string $path, string $storageLink): bool
    {
        $cacheData = [
                      $params['title'] => [
                                           'path'          => $storageLink,
                                           'absolute_path' => $path,
                                           'description'   => $params['description'],
                                          ],
                     ];
        $data      = self::appendArrTagsCache($params['redis_index'], $cacheData);
        $this->generatePublicJsonLinter($data);
        return true;
    }

    /**
     * @param array $data 缓存更新之后的最后数据.
     * @return boolean
     */
    protected function generatePublicJsonLinter(array $data): bool
    {
        $jsonData = json_encode($data, JSON_UNESCAPED_UNICODE);
        Storage::disk('json')->put($this->commonJsonLinterPath, $jsonData);
        return true;
    }

    /**
     * 处理数据
     * @param array $params Params.
     * @return array <string,mixed>
     */
    protected function handleTableData(array $params): array
    {
        $model = new $params['model']();
        //$model = app($params['model']);
        $table_name = $model->getTable();
        $jsonData   = $model->cursor()->pluck('name', 'id')->toJson(JSON_UNESCAPED_UNICODE);
        return [
                'table_name' => $table_name,
                'jsonData'   => $jsonData,
               ];
    }

    /**
     * validate array data
     * @param array $params Params.
     * @return mixed[]
     * @throws \Exception Exception.
     */
    protected function validateData(array $params): array
    {
//        preg_match('/^(?!\,)(?!.*\,$)(?!.*?\,\,)[\w,]{1,20}$/','123');
        $filters   = [
                      'platform_sign' => 'trim|escape',
                      'path'          => 'trim|escape',
                      'type'          => 'trim|escape',
                      'title'         => 'trim|escape',
                      'description'   => 'trim|escape',
                      'table'         => 'trim|escape',
                      'fields'        => 'trim|escape',
                      'use_type'      => 'trim|escape',
                      'table_type'    => 'trim|escape',
                     ];
        $sanitizer = new Sanitizer($params, $filters);
        $params    = $sanitizer->sanitize();
        $validator = Validator::make(
            $params,
            [
             'use_type'      => 'required|integer|in:1,2',//1 common , 2 individual
             'type'          => 'required|integer|in:1,2',//1 是普通数据的结果要存入为json 2 是表的结果要存入为 json  type 1 时不需要 table_name type 2 时需要 table_name
                //             'table_type'    => 'required_if:type,==,2|integer|in:1,2',//1 model 2 table  1 时需要 model参数 2 时需要 table 参数
             'platform_sign' => 'required_if:use_type,==,2|exists:system_platforms,sign',
             'path'          => [
                                 'required',
                                 'regex:/^[^*?"<>|:]*$/',//后面需要再调整 目前有带后缀
                                ],
             'title'         => 'required|alpha_dash',
             'description'   => 'required|string',
                //             'table'         => 'required_if:table_type,==,2|alpha_dash',
             'model'         => 'required',
             'fields'        => 'required_if:type,==,2|regex:/^(?!\,)(?!.*\,$)(?!.*?\,\,)[\w,]{1,20}$/', //id,name,code ...
            ],
        );
        if ($validator->fails()) {
            throw new \Exception($validator->errors());
        }
        return $params;
    }
}
