<?php
/**
 * Explanation:
 * Author: Abner
 * Time: 2021/1/16 19:58
 */

namespace app\common\business;
use app\common\model\mysql\SpecsValue as SpecsValueModel;
use think\facade\Log;

class SpecsValue extends BusBase
{
    public $model = null;
    public function __construct()
    {
        $this->model = new SpecsValueModel();
    }




    public function getBySpecsId($specsId) {
        try {
            $result = $this->model ->getNormalBySpecsId($specsId, 'id,name');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return [];
        }
        return $result = $result->toArray();

    }


}