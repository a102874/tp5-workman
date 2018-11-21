<?php
/**
 * Created by PhpStorm.
 * User: ning
 * Date: 2017/8/25
 * Time: 13:50
 */
namespace app\push\controller;

use think\worker\Server;
use think\Session;


class Worker extends Server
{
    protected $socket = 'websocket://127.0.0.1:2346';

    public      $uidConnections= array();

    /**
     * 收到信息
     * @Author: 296720094@qq.com chenning
     * @param $connection
     * @param $data
     */
    public function onMessage($connection, $data)
    {
        $data=json_decode($data,true);
        switch($data['type']) {
            case 'login':
       // $_SESSION['uid'] = $client_name;
         $recv_uid= Session::get('uid');
         return;
            case 'say':
           if(!isset($_SESSION['uid']))
                {
                    $connection->send('请登录');
                }else {
               $recv_uid = $data['to_uid'];
              sendMessageByUid($recv_uid, $data['chat']);
               $connection->send( $data['chat']);
           }
                return;
        }
        //$connection->send('我收到你的信息了123');

    }

    /**
     * 当连接建立时触发的回调函数
     * @Author: 296720094@qq.com chenning
     * @param $connection
     */
    public function onConnect($connection)
    {
        
    }
	
/* 	public static function onConnect($client_id)
{
    $resData = [
        'type' => 'init',
        'client_id' => $client_id,
        'msg' => 'connect is success' // 初始化房间信息
    ];
    Gateway::sendToClient($client_id, json_encode($resData));
} */
    /**
     * 当连接断开时触发的回调函数
     * @Author: 296720094@qq.com chenning
     * @param $connection
     */
    public function onClose($connection)
    {
        
    }

    /**
     * 当客户端的连接上发生错误时触发
     * @Author: 296720094@qq.com chenning
     * @param $connection
     * @param $code
     * @param $msg
     */
    public function onError($connection, $code, $msg)
    {
        echo "error $code $msg\n";
    }

	
/* 	public function sendMessage($worker$uid,$message){
		
		if(isset($worker->uidConnect['uid']))
		{
			$connection=$worker->uidConnect['uid'];
			$data=$connection->send($message);
			return $data
		}else{
			
			return 201;
		}
		
	} */
    /**
     * 每个进程启动
     * @Author: 296720094@qq.com chenning
     * @param $worker
     */
    public function onWorkerStart($worker)
    {

    }

    // 针对uid推送数据
    function sendMessageByUid($uid, $message)
    {
        global $worker;
        if(isset($worker->uidConnections[$uid]))
        {
            $connection = $worker->uidConnections[$uid];
            $connection->send($message);
        }
    }
}