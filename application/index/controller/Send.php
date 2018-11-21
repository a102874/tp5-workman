<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/12
 * Time: 14:44
 */

namespace app\index\controller;


use GatewayClient\Gateway;

class Send
{
    /*Gateway::$registerAddress = '127.0.0.1:1236';

    // 向任意uid的网站页面发送数据
    Gateway::sendToUid($uid, $message);*/


    function  send_message($uid,$message){
//$Gateway=new Gateway("websocket://0.0.0.0:7272");
        //$Gateway->registerAddress='127.0.0.1:1236';
        //$uid=$_POST['uid'];
        //$message['message']=$_POST['message'];
        Gateway::$registerAddress = '127.0.0.1:1236';
        //$message['type']='say';

        return  Gateway::sendToUid($uid,$message);

    }

}