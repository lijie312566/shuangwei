<?php
require_once __DIR__ . '/Autoloader.php';
use Workerman\Worker;
// 运行在主进程
$tcp_worker = new Worker("ws://0.0.0.0:2200");
// 赋值过程运行在主进程
$tcp_worker->onMessage = function($connection, $data)
{
    // 这部分运行在子进程
    $cmd_msg['cmd']= "TickAck";
    
    $str=substr($data,1);
    $str=substr($data, 0, -1);
    //$data=json_decode($str);
    if(is_object($data) and $data->cmd=='tick'){
	$cmd_msg["imei"]=$data->imei;
        $cmd_msg["cmd"]='cmdack';
	$cmd_msg["result"]=true;
	$cmd_msg['index']=12;
        $cmd_msg['params']=[];
    }
   $msg=$data;
  $redis = new Redis();
   $redis->connect('127.0.0.1', 6379);
    $redis->lpush("devices", $data);
    $connection->send('<'.$msg.'>');
};

Worker::runAll();
