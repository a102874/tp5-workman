<?php
namespace app\index\controller;

use GatewayWorker\Lib\Gateway;
use think\Db;
use think\Session;

class Index extends Base
{
    protected $beforeActionList = [
        'login'
    ];



/*public function __construct() {
    if (!session('adminFlag')) {
        $this->error('请登录', 'Login/index');
    }
}*/
  public $arr=array();


    public function index()
    {
        if (!session('adminFlag')) {
            $this->error('请登录', 'Login/index');
        }else{
           $uinfo=Session::get('UserInfo');

//var_dump(Gateway::isUidOnline(20));die;
            $list=Db::name('friends')->where(array('uid'=>$uinfo['id']))->select();

            foreach ($list as $k=>$v){
               $info=Db::name('shop')->field('shop_name,shop_project,smeta')->where(array('id'=>$v['fid']))->find();
               $list[$k]['shop_name']=$info['shop_name'];
                $list[$k]['shop_project']=$info['shop_project'];
                $list[$k]['smeta']=json_decode($info['smeta'],true);
                $list[$k]['status']=Gateway::isUidOnline($v['fid']);

            }

            $this->assign('info',$uinfo);
            $this->assign('list', $list);
        return view('index');
   }
    }

    function  friends(){

        $uinfo=Session::get('UserInfo');

        $list=Db::name('friends')->field('fid')->where(array('uid'=>$uinfo['id']))->select();

        foreach ($list as $k=>$v){

            $list[$k]['status']=Gateway::isUidOnline($v['fid']);
        }

        return $list;
    }

        public  function login2(){

           // global $ars;


        if(Session::get('uid')) {

            return view('chat');
        }else{
            Session::set('uid',$_POST['uid']);
            return view('chat');

        }
        }

        public  function  chat(){

           /* $chat=new Radis();
            $chat->setChatRecord('404','20','你好','0');*/
            $redis=new \redis();
            $redis -> connect('127.0.0.1',6379);
            $redis->set('test','hello world!');
            echo $redis->get('test');


          //  return view('chat');
           // $count=$chat->getUnreadMsg(404,20);
       //var_dump( $count[2]);
           // $res=json_decode( $count[2],true);
           // echo  $count[2];
         //   var_dump( $res['message']);

        }



        public  function count(){
            Session::delete('userInfo');
            Session::delete('adminFlag');


        }

    function  message(){

        $list=Db::name('chat')->where(array('status'=>0,'fromuserid'=>$_POST['client_name'],'touserid'=>$_POST['to_client']))->select();
        $str="";
        foreach ($list as $k=>$v){
            $str.=$v['message'];
            Db::name('chat')->where(array('id'=>$v['id']))->update(['status'=>1]);
        }
        return $str;
    }

}
