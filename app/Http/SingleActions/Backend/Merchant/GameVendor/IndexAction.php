<?php

namespace App\Http\SingleActions\Backend\Merchant\GameVendor;

use App\Http\Controllers\BackendApi\Merchant\MerchantApiMainController;
use App\ModelFilters\Game\GameVendorPlatformFilter;
use Illuminate\Http\JsonResponse;

/**
 * Class IndexAction
 * @package App\Http\SingleActions\Backend\Merchant\GameVendor
 */
class IndexAction extends BaseAction
{

    /**
     * @var object
     */
    protected $model;
   /**
    * @param MerchantApiMainController $contll     Contll.
    * @param array $inputDatas InputDatas.
    * @return JsonResponse
    * @throws \Exception Exception.
    */
   public function execute(MerchantApiMainController $contll, array $inputDatas) :JsonResponse
   {
       $inputDatas['platform_id'] = $contll->currentAdmin->id;
       $datas = $this->model::with('gameVendor')
           ->orderByDesc('sort')
           ->filter($inputDatas, GameVendorPlatformFilter::class)
           ->withCacheCooldownSeconds(60 * 60 * 24)
           ->get();
       return msgOut(true, $datas);
   }
}