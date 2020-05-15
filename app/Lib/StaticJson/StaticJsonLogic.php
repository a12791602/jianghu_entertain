<?php

namespace App\Lib\StaticJson;

use App\Models\Systems\StaticResource;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Waavi\Sanitizer\Sanitizer;

trait StaticJsonLogic
{

    /**
     * @var string 公共json 存放两件地址
     */
    private $commonJsonLinterPath = 'common/linter.json';

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
     * 处理Command数据
     * @return array <string,mixed>
     */
    protected function handleCommandData(): array
    {
        $validCommand = [];
        $allArtisan   = Artisan::all();
        foreach ($allArtisan as $artisanKey => $commandCollection) {
            $commandClass    = get_class($commandCollection);
            $validClassCheck = Str::startsWith($commandClass, 'App\Console\Commands');
            $validCheck      = $validClassCheck === true && $artisanKey !== 'base';
            if (!$validCheck) {
                continue;
            }
            $validCommand[] = [
                               'sign'        => $artisanKey,
                               'command'     => Str::afterLast($commandClass, '\\'),
                               'description' => $commandCollection->getDescription(),
                              ];
        }
        $jsonData = json_encode($validCommand);
        return ['jsonData' => $jsonData];
    }

    /**
     * @param array       $params     Params.
     * @param string      $path       Path.
     * @param string|null $table_name Table name.
     * @return boolean
     */
    protected function saveStaticRecord(array $params, string $path, ?string $table_name): bool
    {
        $staticResourceData                = Arr::only($params, $this->saveField);
        $staticResourceData['path']        = $path;//覆盖之前的 路径与 拼接后缀的 路径
        $staticResourceData['static_type'] = StaticResource::STATIC_TYPE_JSON;
        switch ($params['type']) {
            case StaticResource::TYPE_WHOLE_TABLE:
                $staticResourceData['table_name'] = $table_name;
                $filterCriteria                   = ['table_name' => $table_name];
                break;
            case StaticResource::TYPE_COMMAND:
            default:
                break;
        }
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
                      'use_type'      => 'trim|escape',
                      'table_type'    => 'trim|escape',
                     ];
        $sanitizer = new Sanitizer($params, $filters);
        $params    = $sanitizer->sanitize();
        $validator = Validator::make(
            $params,
            [
             'use_type'      => 'required|integer|in:1,2',//1 common , 2 individual
             'type'          => 'required|integer|in:1,2,3',//1 是普通数据的结果要存入为json 2 是表的结果要存入为 json  type 1 时不需要 table_name type 2 时需要 table_name
                //             'table_type'    => 'required_if:type,==,2|integer|in:1,2',//1 model 2 table  1 时需要 model参数 2 时需要 table 参数
             'platform_sign' => 'required_if:use_type,==,2|exists:system_platforms,sign',
             'path'          => [
                                 'required',
                                 'regex:/^[^*?"<>|:]*$/',//后面需要再调整 目前有带后缀
                                ],
             'title'         => 'required|alpha_dash',
             'description'   => 'required|string',
                //             'table'         => 'required_if:table_type,==,2|alpha_dash',
             'model'         => 'required_if:type,==,2',
             'fields'        => 'required_if:type,==,2|array',
             'relations'     => 'array',
             'fields.*'      => 'alpha_dash|between:1,50', //id,name,code ...
            //             'fields'        => 'required_if:type,==,2|regex:/^(?!\,)(?!.*\,$)(?!.*?\,\,)[\w,]{1,20}$/', //id,name,code ...
            ],
        );
        if ($validator->fails()) {
            throw new \Exception($validator->errors());
        }
        return $params;
    }
}
