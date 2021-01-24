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
        $filename = '/upload/'.str_replace("\\","/",$filename);
        if(!$filename) {
            return show(config('status.error'), '上传失败！');
        }
        return show(config('status.success'), 'OK',['image'=>$filename]);
    }


    public function layUpload(){
        if(!$this->request->isPost()){
            return json(['code'=>1, 'msg'=>'上传失败','data'=>[]],200);
        }
        $file = $this->request->file('file');
        $filename = \think\facade\Filesystem::disk('public')->putFile('images',$file);
        $filename = '/upload/'.str_replace("\\","/",$filename);
        if(!$filename) {
            return json(['code'=>1, 'msg'=>'上传失败','data'=>[]],200);
        }
        $result = [
            'code' => 0,
            'data' => [
                'src' =>$filename,
            ],
        ];

        return json($result,200);
    }


}