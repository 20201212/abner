<?php
/**
 * Explanation:
 * Author: Abner
 * Time: 2021/1/10 21:49
 */

namespace app\admin\controller;
class Specs extends AdminBase
{
    public function dialog() {

//        return json(config('specs'));
        return view('', ['specs' => json_encode(config('specs'))]);
    }

}