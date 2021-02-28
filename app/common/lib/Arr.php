<?php
/**
 * Explanation:
 * Author: Abner
 * Time: 2021/1/10 17:20
 */

namespace app\common\lib;
class Arr
{
    /**
     * Explanation：无限级分类
     * Author: Abner
     * Time: 2021/1/10 17:33
     * @param $data
     * @return array
     */
    public  static function getTree($data){
        $items = [];
        foreach($data as $v){
            $items[$v['category_id']] =$v;
        }
        $tree = [];
        foreach($items as $id => $item ){
            if(isset($items[$item['pid']])) {
                $items[$item['pid']]['list'][] = &$items[$id];
            }else{
                $tree[]=&$items[$id];
            }
        }

        return $tree;
    }

    /**
     * Explanation：截取指定长度的分类数据
     * Author: Abner
     * Time: 2021/1/10 18:08
     * @param $data
     * @param int $firstCount
     * @param int $secondCount
     * @param int $threeCount
     * @return array
     */
    public static function sliceTreeArr($data, $firstCount=5,$secondCount=3,$threeCount=3){
        $data = array_slice($data, 0, $firstCount);
        foreach($data as $k=>$v) {
            if(!empty($v['list'])) {
                $data[$k]['list'] = array_slice($v['list'], 0, $secondCount);
                foreach($v['list'] as $kk=>$vv){
                    if(!empty($data[$k]['list'][$kk]['list']))
                        $data[$k]['list'][$kk]['list']=array_slice($vv['list'], 0, $threeCount);
                }
            }
        }
        return $data;
    }


    /**
     * Explanation：分页默认返回的数据
     * Author: Abner
     * Time: 2021/1/24 22:38
     * @param $num
     */
    public static function getPaginateDefaultData($num){
        $result = [
            'total'         => 0,
            'per_page'      => $num,
            'current_page'  => 1,
            'last_page'     => 0,
            'data'          => [],
        ];
    }

    /**
     * Explanation：根据数组的某值排序
     * Author: Abner
     * Time: 2021/2/28 21:53
     * @param $result
     * @param $key
     * @return array|bool
     */
    public static function arrsSortByKey($result,$key, $sort = SORT_DESC) {
        if(!is_array($result) || !$key) {
            return [];
        }
        array_multisort(array_column($result, $key), $sort, $result);
        return $result;
    }


}