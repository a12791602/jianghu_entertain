<?php

namespace App\Http\SingleActions\Backend\Headquarters\Game\GameType;

use App\ModelFilters\Game\GamesTypeFilter;
use App\Models\Game\GameType;
use Illuminate\Http\JsonResponse;

/**
 * Class IndexDoAction
 * @package App\Http\SingleActions\Backend\Headquarters\GameType
 */
class IndexDoAction
{

    /**
     * @param array<string,string> $inputDatas InputData.
     * @return JsonResponse
     * @throws \RuntimeException Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        $outputDatas = GameType::with(
            [
             'lastEditor:id,name',
             'author:id,name',
             'children:id,parent_id,name,sort,sign',
            ],
        )->ordered()->filter($inputDatas, GamesTypeFilter::class)->get();
        $msgOut      = msgOut($outputDatas);
        return $msgOut;
    }
}
