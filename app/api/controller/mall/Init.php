<?php
/**
 * Explanation:
 * Author: Abner
 * Time: 2021/2/28 22:01
 */

namespace app\api\controller\mall;
use app\api\controller\AuthBase;
use app\common\business\Cart as CartBis;
use app\common\lib\Show;

class Init extends AuthBase
{
    public function index(){
        if(!$this->request->isPost()){
//            return Show::error();
        }
        $count = (new CartBis()) ->getCount($this->userId);
        return Show::success(['count_num'=>$count]);
    }

}