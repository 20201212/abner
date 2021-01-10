<?php
/**
 * Explanation: 分类验证器
 * Author: Abner
 * Time: 2021/1/7 21:31
 */

namespace app\admin\validate;
use think\Validate;

class Category extends Validate
{
    protected $rule = [
        'name'      => 'require',
        'pid'       => 'require',
        'id'        => 'require',
        'status'    => ['require', 'in'=>'0,1,99'],

    ];

    protected $message = [
        'name'              => '分类名称不能为空',
        'pid'               => '父级id不能为空',
        'id'                => '排序id并不能为空',
        'status.require'    => '状态不能为空',
        'status.in'         => '参数不合法',
    ];

    protected $scene = [
        'listorder' => ['id'],
        'save'      => ['name','pid'],
        'status'    => ['id','status'],
    ];



}