<?php
/**
 * Explanation:
 * Author: Abner
 * Time: 2021/1/16 21:49
 */

namespace app\admin\controller;
class Image extends AdminBase
{
    public function upload(){
        if(!$this->request->isPost()){
            return show(config('status.error'), '请求不合法');
        }
        $file = $this->request->file('file');
        $filename = \think\facade\Filesystem::disk('public')->putFile('images',$file);
        if(!$filename) {
            return show(config('status.error'), '上传失败！');
        }
        return show(config('status.success'), 'OK',['filename'=>$filename]);
    }

}