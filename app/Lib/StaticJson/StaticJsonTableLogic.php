<?php


namespace App\Lib\StaticJson;

/**
 * Trait StaticJsonTableLogic
 * @package App\Lib\StaticJson
 */
trait StaticJsonTableLogic
{
    /**
     * 处理表数据
     * @param array $params Params.
     * @return array <string,mixed>
     */
    protected function handleTableData(array $params): array
    {
        if (isset($params['relations'])) {
            return $this->handleMultipleTableData($params);
        }
        return $this->handleSingleTable($params);
    }

    /**
     * 处理多张表表数据
     * @param array $params Params.
     * @return array <string,mixed>
     */
    protected function handleMultipleTableData(array $params): array
    {
        $withData = [];
        foreach ($params['relations'] as $relKey => $relValue) {
            $withData[$relKey] = $this->generateClosure($relValue);
        }
        $model      = new $params['model']();
        $table_name = $model->getTable();
        $jsonData   = $params['model'] ::with($withData)
            ->get($params['fields'])
            ->toJson(JSON_UNESCAPED_UNICODE);
        return [
                'table_name' => $table_name,
                'jsonData'   => $jsonData,
               ];
    }

    /**
     * @param array $fields Fields.
     * @return \Closure
     */
    protected function generateClosure(array $fields): \Closure
    {
        return static function ($query) use ($fields): void {
            $query->select($fields);
        };
    }

    /**
     * 处理表数据
     * @param array $params Params.
     * @return array <string,mixed>
     */
    protected function handleSingleTable(array $params): array
    {
        $model = new $params['model']();
        //$model = app($params['model']);
        $table_name = $model->getTable();
        $jsonData   = $model->cursor()->map(
            static function ($data) use ($params) {
                return collect($data->toArray())
                    ->only($params['fields']);
            },
        )->toJson(JSON_UNESCAPED_UNICODE);
        return [
                'table_name' => $table_name,
                'jsonData'   => $jsonData,
               ];
    }
}
