<?php
/**
 * Explanation:
 * Author: Abner
 * Time: 2021/1/7 21:55
 */

namespace app\common\business;
use \app\common\model\mysql\Category as CategoryModel;
use think\Exception;
use think\facade\Log;

class Category
{
    public $model = null;
    public function __construct(){
        $this->model = new CategoryModel();
    }
    public function getLists($data,$page){
        $list = $this->model->getLists($data,$page);
        if(!$list) {
            return [];
        }
        $categorys = $list->toArray();
        $categorys['render'] = $list->render();
        $pids = array_column($categorys['data'],'id');

        if($pids){
            $idCountResult = $this->model->getChildCountInPids(['pid'=>$pids]);
            $idCountResult = $idCountResult->toArray();
            $idCounts = [];
            foreach ($idCountResult as $countResult){
                $idCounts[$countResult['pid']] = $countResult['count'];
            }

        }
        if($categorys['data']){
            foreach($categorys['data'] as  $k =>$value ){
                $categorys['data'][$k]['childCount'] = $idCounts[$value['id']] ?? 0;
            }
        }
        return $categorys;


    }

    public function add($data){
        $data['status'] = config('status.mysql.table_normal');
//        $res = $this->model->where('name',$data['name'])->find();
//        if($res){
//
//            return show(config('status.error'), '分类名已经存在！');
//        }
        try {
           $this->model->save($data);
        } catch ( \Exception $e ){
          throw new \think\Exception('数据库异常！');
        }
        return $this->model->id;

    }

    /**
     * Explanation：获取所欲的分类
     * Author: Abner
     * Time: 2021/1/10 17:15
     * @return array|\think\Collection|null
     */
    public function getNormalCategorys(){
        $field = 'id,name,pid';

        $categorys = $this->model->getNormalCategorys($field);
        if(!$categorys) {
            return $categorys;
        }
        return $categorys ->toArray();
    }

    public function getNormalAllCategorys(){
        $field = 'id as category_id ,name,pid';

        $categorys = $this->model->getNormalCategorys($field);
        if(!$categorys) {
            return $categorys;
        }
        return $categorys ->toArray();
    }

    public function listorder($id, $listorder){
        $res = $this->getById($id);
        if(!$res){
           throw new \think\Exception('不存在该记录！！');;
        }
        $data = [
            'listorder'     => $listorder,
            'update_time'   => time(),
        ];
        try {
            $res = $this->model->updateById($id,$data);
        } catch (\Exception $e ){
            return false;
        }

    }

    public function getById($id){
        $result = $this->model->find($id);
        if(empty($result)){
            return [];
        }
        $result = $result->toArray();
        return $result;
    }

    public function status($id,$status){

        $result = $this->model->find($id);
        if(!$result){
            throw new \think\Exception('该条记录不存在！');
        }
        if($result['status'] == $status) {
            throw new \think\Exception('该修改状态和原始状态一样！');
        }
        $data = [
            'status'        => intval($status),
            'update_time'   => time(),
        ];
        try {
            $res = $this->model->updateById($id,$data);
        } catch (\Exception $e){
            return false;
//            return show(config('status.error'), $e->getMessage());
        }

        return $res;

    }


    public function getNormalByPid($pid = 0, $field = 'id,name,pid'){
        try {
            $res = $this->model->getNormalByPid($pid,$field);
        }catch (\Exception $e) {
            Log::error($e->getMessage());
            return [];
        }
        $res = $res -> toArray();
        return $res;
    }









}