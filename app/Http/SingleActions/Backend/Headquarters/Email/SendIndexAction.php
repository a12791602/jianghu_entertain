<?php

namespace App\Http\SingleActions\Backend\Headquarters\Email;

use App\Models\Email\SystemEmail;
use Illuminate\Http\JsonResponse;

/**
 * Class SendIndexAction
 * @package App\Http\SingleActions\Backend\Headquarters\Email
 */
class SendIndexAction extends BaseAction
{

    /**
     * @var object $model
     */
    protected $model;

    /**
     * @param array $inputDatas InputDatas.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function execute(array $inputDatas): JsonResponse
    {
        if (isset($inputDatas['pageSize'])) {
            $this->model->setPerPage($inputDatas['pageSize']);
        }
        $outputDatas = $this->model::with('headquarters:id,name')
            ->filter($inputDatas)
            ->where('type', SystemEmail::TYPE_HEAD_TO_MER)
            ->orderByDesc('created_at')
            ->paginate();
        return msgOut($outputDatas);
    }
}
