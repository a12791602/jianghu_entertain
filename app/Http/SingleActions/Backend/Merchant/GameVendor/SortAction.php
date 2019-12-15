<?php
namespace App\Http\SingleActions\Backend\Merchant\GameVendor;

use Illuminate\Http\JsonResponse;

class SortAction extends BaseAction
{
   /**
    * @param array $inputDatas     InputDatas.
    * @return JsonResponse
    * @throws \Exception Exception.
    */
   public function execute(array $inputDatas) :JsonResponse
   {
       try {
            foreach ($inputDatas['sorts'] as $inputData) {
                $this->model::where('id',$inputData['id'])->update(['sort'=>$inputData['sort']]);
            }
            return msgOut(true);
       } catch (\Exception $exception) {
           throw new \Exception('200100');
       }
   }
}