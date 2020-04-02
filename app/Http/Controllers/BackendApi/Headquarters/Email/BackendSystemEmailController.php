<?php

namespace App\Http\Controllers\BackendApi\Headquarters\Email;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Headquarters\Email\ReadEmailRequest;
use App\Http\Requests\Backend\Headquarters\Email\ReceivedIndexRequest;
use App\Http\Requests\Backend\Headquarters\Email\SendIndexRequest;
use App\Http\Requests\Backend\Headquarters\Email\SendRequest;
use App\Http\SingleActions\Backend\Headquarters\Email\ContactAction;
use App\Http\SingleActions\Backend\Headquarters\Email\ReadEmailAction;
use App\Http\SingleActions\Backend\Headquarters\Email\ReceivedIndexAction;
use App\Http\SingleActions\Backend\Headquarters\Email\RecentContactAction;
use App\Http\SingleActions\Backend\Headquarters\Email\SendAction;
use App\Http\SingleActions\Backend\Headquarters\Email\SendIndexAction;
use Illuminate\Http\JsonResponse;

/**
 * 总控的邮件系统控制器
 * Class BackendSystemEmailController
 *
 * @package App\Http\Controllers\BackendApi\Headquarters\Email
 */
class BackendSystemEmailController extends Controller
{
    /**
     * 发送邮件
     *
     * @param  SendAction  $action  Action.
     * @param  SendRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function send(
        SendAction $action,
        SendRequest $request
    ): JsonResponse {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }

    /**
     * 已发邮件.
     *
     * @param SendIndexAction  $action  Action.
     * @param SendIndexRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function sendIndex(SendIndexAction $action, SendIndexRequest $request): JsonResponse
    {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }

    /**
     * 已收邮件.
     *
     * @param ReceivedIndexAction  $action  Action.
     * @param ReceivedIndexRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function receivedIndex(
        ReceivedIndexAction $action,
        ReceivedIndexRequest $request
    ): JsonResponse {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }

    /**
     * 最近联系人.
     *
     * @param RecentContactAction $action Action.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function recentContact(RecentContactAction $action): JsonResponse
    {
        return $action->execute();
    }

    /**
     * 联系人.
     *
     * @param ContactAction $action Action.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function contact(ContactAction $action): JsonResponse
    {
        return $action->execute();
    }

    /**
     * 读邮件.
     *
     * @param ReadEmailAction  $action  Action.
     * @param ReadEmailRequest $request Request.
     * @return JsonResponse
     * @throws \Exception Exception.
     */
    public function readEmail(ReadEmailAction $action, ReadEmailRequest $request): JsonResponse
    {
        $inputDatas = $request->validated();
        return $action->execute($inputDatas);
    }
}
