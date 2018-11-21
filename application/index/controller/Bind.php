<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/12
 * Time: 10:13
 */

namespace app\index\controller;

use GatewayClient\Gateway;
use think\Session;

class bind
{

/*
public Gateway::$registerAddress = '127.0.0.1:1236';

// 假设用户已经登录，用户uid和群组id在session中
$uid      = $_SESSION['uid'];
$group_id = $_SESSION['group'];
// client_id与uid绑定
Gateway::bindUid($client_id, $uid);*/

  function  index(){


      $chat=new chat();
      $photo=$chat->photo($id=404);
  }



    function  bind_user( $client_id,$uid){
        Gateway::$registerAddress = '127.0.0.1:1236';
       //$Gateway=new Gateway("websocket://0.0.0.0:7272");
       // $Gateway->registerAddress = '127.0.0.1:1236';
       /* $Gateway->registerAddress = '127.0.0.1:1236';*/
        // 服务注册地址
       // $Gateway->registerAddress = '127.0.0.1:1236';


       /* $uid = Session::get('uid');*/
        //$uid=Session::get('uid');

       // $uid=Session::get['uid'];
        //$client_id=$_POST['client_id'];
        //var_dump($client_id);die;


       return Gateway::bindUid($client_id, $uid);
    }



}