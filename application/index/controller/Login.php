<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/15
 * Time: 14:55
 */

namespace app\index\controller;

use app\admin\controller\Base;
use GatewayWorker\Lib\Gateway;
use think\Controller;
use think\Db;

class Login  extends  controller
{

    function index(){


        return $this->fetch();
    }


    function  login(){

        $uname =$_REQUEST['phone'];
        $upass = md5($_REQUEST['password']);
        //dump($upass);
        $user =Db::table('car_shop')->where(array('shop_phone'=>$uname,'password'=>$upass)) -> find();

        if ($user) {
            //登录成功后 将用户信息保存在session中 方便访问
            session('UserInfo', $user);
            session('adminFlag', true);
            $arr['statu']=1;
        } else {
            $arr['statu']=2;
            $arr['msg']='账号或密码错误';
        }

        return json ($arr);

    }



}