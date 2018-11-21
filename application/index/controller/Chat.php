<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/19
 * Time: 9:34
 */

namespace app\index\controller;


use think\Db;
use think\Session;

class chat
{
    function  photo($id){


        $smeta=Db::name('shop')->where(array('id'=>$id))->value('smeta');
        $smeta=json_decode($smeta,true);

       $photo='http://api.helianche.cn/'.$smeta['thumb'];

        return $photo;
    }

    function sid(){
        $userinfo=Session::get('UserInfo');
        return  $userinfo['id'];
    }

    function save_message($k,$m,$n,$f){

       // $redis=new Radis();
       // $redis->setChatRecord($k,$m,$n,$f);

        $arr['message']=$n;
        $arr['touserid']=$k;
        $arr['fromuserid']=$m;
        $arr['status']=$f;
        $arr['time']=time();
        $res=Db::name('chat')->save($arr);
        return $res;
    }



}