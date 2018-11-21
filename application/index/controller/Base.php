<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/15
 * Time: 14:55
 */

namespace app\index\controller;


use think\Controller;

use think\Db;

class Base extends  controller
{
    function login()
    {
        if (!session('adminFlag')) {
            $this->error('请登录', 'Login/index');
        }
    }
}