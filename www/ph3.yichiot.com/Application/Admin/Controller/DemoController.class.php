<?php
namespace Admin\Controller;
use Common\Controller\AdminBaseController;
/**
 * 设备列表页  
 */
class DemoController extends AdminBaseController{
  
  //判断用户身份,进入不同的列表页
  public function index(){

   //Connecting to Redis server on localhost
   $redis = new Redis();
   $redis->connect('127.0.0.1', 6379);

  echo '111';

   // Get the stored data and print it
   $arList = $redis->lrange("devicesdata", 0 ,100);
     echo '222';
   foreach($arList as $k=>$v){
       if(strpos($v,'imei')){
                $a=str_replace('<','',$v);
                $b=str_replace('>','',$a);
                echo $b.'</br>';
        }
    }

  }

}