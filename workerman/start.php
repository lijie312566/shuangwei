<?php
require_once __DIR__ . '/Autoloader.php';
use Workerman\Worker;
// 运行在主进程
$tcp_worker = new Worker("tcp://0.0.0.0:2100");  

$clients = []; //保存客户端信息

// 赋值过程运行在主进程
$tcp_worker->onMessage = function($connection, $data){
	global $clients;
	
	$fdata=$data;
	$format_data=str_replace('<','',$data);
	$format_data=str_replace('>','',$format_data);
	$cmd_obj=json_decode($format_data);
	$biz_array=[];
	
	if(is_object($cmd_obj)){
		//file_put_contents('imei.ini', $data."\r\n\r\n", FILE_APPEND); 
		//存储新登录用户的数据
		if(!empty($cmd_obj->imei)){
			$clients[$cmd_obj->imei] = $connection;	
		}		
		
		switch ($cmd_obj->cmd){
			//查询设备在线情况
			case 'List':
				$imeis = '';
				$i = 1;
				foreach($clients as $k=>$v){
					$imeis .= '设备'.$i.':'.$k."\r\n";
					$i = $i + 1;
				}	
				$connection->send('当前在线设备共：'.count($clients).'个！(super8888888888是本链接)'."\r\n".$imeis."\r\n");				
				break;				
			case 'Tick':				
				//组装给设置响应的数据
				$biz_array=[
					"imei"=> $cmd_obj->imei,
					"index"=> $cmd_obj->index,
					"cmd"=>$cmd_obj->cmd.'Ack',
					"result"=>true,					
					"params"=> [
						"time"=>time()
					]
				];
				$biz_msg = '<'.json_encode($biz_array).'>';
				$connection->send($biz_msg);
				if(isset($clients['super8888888888'])){
					$clients['super8888888888']->send($data."\r\n\r\n");	
				}				
				//存储设备发送过来的数据
				$redis = new Redis();
				$redis->connect('127.0.0.1', 6379);      
				$redis->lpush("devicesdata", $data);
				break;
			
			//Led 远程控制 [服务器--->设备]
			case 'Led':
				//组装给设备发送的数据
				$biz_array=[
					"imei"=> $cmd_obj->toimei,
					"index"=> $cmd_obj->index,
					"cmd"=>$cmd_obj->cmd,				
					"params"=> $cmd_obj->params,
				];
				if(isset($clients[$cmd_obj->toimei])){
					$biz_msg = '<'.json_encode($biz_array).'>';
					$clients[$cmd_obj->toimei]->send($biz_msg);
					file_put_contents('Led.txt', $biz_msg."\r\n", FILE_APPEND);
				}else{
					$clients['super8888888888']->send('-1');
				}				
				break;
			
			//呼唤设备响应信息
			case 'LedAck':
				$biz_msg = $cmd_obj->params->msg;
				$clients['super8888888888']->send($biz_msg);
				break; 
				
			//ConfigDevice 设备参数配置[服务器--->设备]
			case 'ConfigDevice':
				//组装给设备发送的数据
				$biz_array=[
					"imei"=> $cmd_obj->toimei,
					"index"=> $cmd_obj->index,
					"cmd"=>$cmd_obj->cmd,				
					"params"=> $cmd_obj->params
				];
				if(isset($clients[$cmd_obj->toimei])){
					$biz_msg = '<'.json_encode($biz_array).'>';
					$clients[$cmd_obj->toimei]->send($biz_msg);
				}else{
					$biz_msg = '<'.json_encode($biz_array).'>';
					$clients['super8888888888']->send('-1');
				}
				break;
				
			//配置设备响应信息
			case 'ConfigDeviceAck':
				$biz_msg = $cmd_obj->params->msg;
				$clients['super8888888888']->send($biz_msg);
				break; 
				
			//UpdateSoft 设备远程升级[服务器--->设备]
			case 'UpdateSoft':
				//组装给设备发送的数据
				$biz_array=[
					"index"=> $cmd_obj->index,
					"cmd"=>$cmd_obj->cmd,				
					"params"=> $cmd_obj->params
				];
				$j = 0;
				foreach($clients as $k=>$v){
					if($k != 'super8888888888'){
						$biz_msg = '<'.json_encode($biz_array).'>';
						$v->send($biz_msg);	
						$j = $j + 1;
					}
				}
				$biz_msg = '<'.json_encode($biz_array).'>';
				$clients['super8888888888']->send('updatasoft:'.$j);
				break;
				
			//设备远程升级响应信息
			case 'UpdateSoftAck':
				$biz_msg = $cmd_obj->params->msg;
				$clients['super8888888888']->send($data);
				break; 
				
			case 'location':
				$biz_array=[
					"imei"=> $cmd_obj->imei,
					"cmd"=>$cmd_obj->cmd.'ack',
					"result"=>true,
					"index"=> $cmd_obj->index,
					"params"=> [
				
					]
				];
				break;
			case 'calibdata':
				$biz_array=[
				
				"imei"=> $cmd_obj->imei,
				"cmd"=>$cmd_obj->cmd.'ack',
				"result"=>true,
				"index"=> $cmd_obj->index,
				"params"=>[
					"count"=> 3, 
					"datas"=> [
					[
						"d"=>123,
						"a"=>0, 
					],
					[
						"d"=>1123,
						"a"=>500
					],
					[
						"d"=>3123,
						"a"=>1000
					]
						
					]
					]
								
				];
				break;

			case 'usoftupdate':
				$biz_array=[
				
				"imei"=> $cmd_obj->imei,
				"cmd"=>'usoftupdateack',
				"result"=>true,
				"index"=> $cmd_obj->index,
				"params"=> [
					"usoftver"=> 102, //更新目标代码的软件版本。
					"url"=> 'http://www.yichiot.com/download/files/demo.bin'
					
				]];
				break;


			case 'dsoftupdate':
				$biz_array=[
				
				"imei"=> $cmd_obj->imei,
				"cmd"=>'dsoftupdateack',
				"result"=>true,
				"index"=> $cmd_obj->index,
				"params"=> [
				"usoftver"=> 102, //更新目标代码的软件版本。
				"url"=> 'http://www.yichiot.com/download/files/demo.bin'
						
						]];
				break;
		}
	}
};
Worker::runAll();
