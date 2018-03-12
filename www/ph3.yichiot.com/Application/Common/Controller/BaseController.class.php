<?php
namespace Common\Controller;
use Think\Controller;
/**
 * Base基类控制器
 */
class BaseController extends Controller{
    /**
     * 初始化方法
     */
    public function _initialize(){
	   		/*$redis = new Redis();
	        $redis->connect('127.0.0.1', 6379);
	        $arList = $redis->lrange("devicesdata", 0 ,100);

		   foreach($arList as $k=>$v){
		       if(strpos($v,'imei')){
		                $a=str_replace('<','',$v);
		                $b=str_replace('>','',$a);
		                echo $b.'</br>';






		                
		        }
		    }




	       $device_sn = $data['device_sn'];
	       $data['time'] = time();
	       $result = M('cycle')->add($data); 
	       if($result){
		       $equip = M('equipment')->where(array('device_sn'=>$device_sn))->save($data);
	       }
   	}

*/







    }

}
