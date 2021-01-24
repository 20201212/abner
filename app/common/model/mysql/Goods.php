<?php
/**
 * Explanation:
 * Author: Abner
 * Time: 2021/1/16 22:25
 */

namespace app\common\model\mysql;

class Goods extends BaseModel
{
    /**
     * Explanation：搜索器
     * Author: Abner
     * Time: 2021/1/24 22:48
     * @param $query
     * @param $value
     */
    public function searchTitleAttr($query,$value){
        $query->where('title', 'like', '%'.$value.'%');
    }
    public function searchCreateTimeAttr($query, $value){
        $query->whereBetweenTime('create_time', $value[0], $value[1]);
    }
    public function getLists($linkKeys,$data, $num =10){
        $order = [
            'listorder' => 'desc',
            'id'        => 'desc',
        ];
        if(!empty($likeKeys)){
            $res = $this->withSearch($linkKeys, $data);
        }else{
            $res = $this;
        }
        $list = $res ->whereIn('status', [0,1])
            ->order($order)
            ->paginate($num);
        return $list;
    }
}