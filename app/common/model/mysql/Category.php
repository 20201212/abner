<?php
/**
 * Explanation:
 * Author: Abner
 * Time: 2021/1/7 22:02
 */

namespace app\common\model\mysql;

class Category extends  BaseModel
{
    protected $autoWriteTimestamp = true;

    public function getNormalCategorys($field='*'){
        $order = [
            'listorder' => 'desc',
            'id'        => 'desc',
        ];
        $res = $this->field($field)
              ->where('status', config('status.mysql.table_normal'))
              ->order($order)
              ->select();
        return $res;
    }

    /**
     * Explanation：获取分类列表
     * Author: Abner
     * Time: 2021/1/10 15:55
     * @param $where
     * @param $page
     * @return \think\Paginator
     * @throws \think\db\exception\DbException
     */
    public function getLists($where,$page){
        $order = [
            'listorder' => 'desc',
            'id'        => 'desc',
        ];
        $result = $this->where('status', '<>', config('status.mysql.table_delete'))
                ->where($where)
                ->order($order)
                ->paginate($page);
        return $result;
    }



    public function getChildCountInPids($pids){
        $where[] = ['pid','in',$pids['pid']];
        $where[] = ['status', '<>', config('status.mysql.table_delete')];
        $res = $this->where($where)
             ->field(['pid','count(*) as count'])
             ->group('pid')
             ->select();
//        echo $this->getLastSql();die();
        return $res;
    }

    public function getNormalByPid($pid,$field){
        $where = [
            'pid'       => $pid,
            'status'    => config('status.mysql.table_normal'),
        ];
        $order = [
            'listorder' => 'desc',
            'id'        => 'desc',
        ];
        $res = $this->where($where)->field($field)->order($order)->select();
        return $res;

    }











}