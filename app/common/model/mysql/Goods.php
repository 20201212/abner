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



    public function getNormalGoodsByCondition($where,$field=true,$limit=5){
        $order = [
            'listorder' => 'desc',
            'id'        => 'desc',
        ];
        $where['status']    = config('status.mysql.table_normal');

        $result = $this
            ->order($order)
            ->where($where)
            ->field($field)
            ->limit($limit)
//            ->fetchSql()
            ->select();
        return $result;

    }

    public function getNoramlGoodsFindInSetCategroyId($categoryId,$field=true){
        $order = [
            'listorder' => 'desc',
            'id'        => 'desc',
        ];
        $where['status']    = config('status.mysql.table_normal');
        $result = $this
            ->whereFindInSet('category_path_id', $categoryId)
            ->order($order)
            ->where($where)
            ->field($field)
            ->limit(10)
            ->select();
        return $result;
    }

    public function getNormalLists($data, $num=10, $field = true,$order){

        $res = $this;
        if(isset($data['category_path_id']))  {
            $res = $this->whereFindInSet('category_path_id', $data['category_path_id']);
        }
        $list = $res->where('status', '=',config('status.mysql.table_normal'))
            ->order($order)
            ->field($field)
            ->fetchSql()
            ->paginate($num);
        return $list;
    }


    public function getImageAttr($value){
        return request()->domain().$value;
    }

    public function getCarouselImageAttr($value){
        if(!empty($value)){
            $value = explode(',', $value);
            $value = array_map(function($v){
                return request()->domain().$v;
            },$value);
        }
        return $value;
    }























}