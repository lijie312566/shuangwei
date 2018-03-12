<?php
error_reporting(0);

$m = trim($_POST['m']);
$toimei = trim($_POST['imei']);

if(empty($m)){
	echo json_encode(['status'=>-1, 'msg'=>'操作指令m不能为空']);exit;
}
if($m!='UpdateSoft' && empty($toimei)){
	echo json_encode(['status'=>-1, 'msg'=>'操作设备imei不能为空']);exit;
}
$cmd_str = '';
switch ($m){
	//Led 呼唤设备
	case 'List':
		$cmd_str = '';
		break;
	case 'Led':	
		$cmd_str = '<{"imei":"super8888888888","toimei":"'.$toimei.'","index":200,"cmd":"Led","params":{"ch":1,"vl":3}}>';
		break;
	case 'ConfigDevice':
		$prd = $_POST['prd'];
		$lhs = $_POST['lhs'];
		$lls = $_POST['lls'];
		$lht = $_POST['lht'];
		$llt = $_POST['llt'];
		$lhh = $_POST['lhh'];
		$llh = $_POST['llh'];
		$cmd_str = '<{"imei":"super8888888888","toimei":"'.$toimei.'","index":200,"cmd":"ConfigDevice","params":{"PRD":'.$prd.',"LHS":'.$lhs.',"LLS":'.$lls.',"LHT":'.$lht.',"LLT":'.$llt.',"LHH":'.$lhh.',"LLH":'.$llh.'}}>';
		break;
	case 'UpdateSoft':
		$url = $_POST['url'];
		$version = $_POST['version'];
		$cmd_str = '<{"imei":"super8888888888","index":200,"cmd":"UpdateSoft","params":{"url":"'.$url.'","version":"'.$version.'","type":"MC20"}}>';
		break;
}

if($cmd_str == ''){
	echo json_encode(['status'=>-1, 'msg'=>'根据操作指令'.$m.'没有找到对应的指令代码']);exit;
}
//echo 'result:'.$cmd_str;exit;  

$socket = stream_socket_client('tcp://47.95.192.25:2100', $errno, $errstr, 10);
stream_socket_sendto($socket, $cmd_str, STREAM_OOB);

$res = '';
if (!$socket) {
    $res = "$errstr($errno)";
	fclose($socket);
	echo json_encode(['status'=>-1, 'msg'=>$res]);
} else {
    fwrite($socket, "\n");
    $res = fread($socket, 26);
	fclose($socket);
	
	if($res == 'OK'){
		echo json_encode(['status'=>1, 'msg'=>'success']);
	}else if($res == -1){
		echo json_encode(['status'=>-1, 'msg'=>'设备未连接']);
	}else if(strpos($res, 'updatasoft')>-1){
		$j = str_replace('updatasoft:', '', $res);
		echo json_encode(['status'=>1, 'msg'=>'已通知'.$j.'个设备升级']);
	}else{
		echo json_encode(['status'=>-1, 'msg'=>'结果未知,返回信息为:'.$res]);
	}    
}

?>