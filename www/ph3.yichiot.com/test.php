<?php

function  get_redis(){
   //Connecting to Redis server on localhost
   $redis = new Redis();
   $redis->connect('127.0.0.1', 6379);


   // Get the stored data and print it
   $arList = $redis->lrange("devicesdata", 0 ,-1);
 //  echo '111';
//var_dump($arList);die;
    $redis->delete('devicesdata');

$conn=new mysqli('47.95.192.25','sw_dba','sw2017','sw','3306');  
if(!$conn){  
    die('数据库打开失败');  
}else{
  echo '连接成功';
}  

$uid = $redis->lrange("uid",0,100);
//var_dump($uid);die;

    // Get the stored data and print it
    foreach($arList as $k=>$v){
       if(strpos($v,'imei')){
                $a=str_replace('<','',$v);
                $b=str_replace('>','',$a);
                //echo $b.'</br>';

                $arr = (array)(json_decode($b,TRUE));    
                   //echo '<pre>';
                  //var_dump($arr);die;
                foreach ($arr as $key => $val) {  

                    $device_sn='';      $electricity='';        $temperature='';        $humidity='';        $time='';
                    $device_sn =$arr['imei']; 


                    $electricity =$arr['params']['voltage']; 
                    $temperature =($arr['params']['tempe']/10)-273; 
                    $humidity =($arr['params']['humidity']/10); 

                    $concentration = $arr['params']['sensor'];

                    $lon = $arr['params']['lon'];
                    $lat = $arr['params']['lat'];

                    $devtype = $arr['params']['devtype'];//设备类型

                    $errno = $arr['params']['errno'];

                    if($errno==0){
                        $device_status = 1;
                    }

                    //判断接受到的错误
                    if($errno == 8002 || $errno ==8003 ||$errno ==8004 ||$errno ==8005 || $errno == 8006 ||$errno ==8007){
                        $device_status = 2;
                    }
                      
                     if($errno == 8008){
                        $device_status = 3;
                     } 

                     if($errno == 8009 || $errno == 8001 ||$errno ==8010){
                        $device_status =4;
                     }


                    if(isset($arr['params']['usoftver'])){
                          $usoftver = $arr['params']['usoftver']; //软件版本号[MC20]
                    }

                    if(isset($arr['params']['dsoftver'])){
                          $dsoftver = $arr['params']['dsoftver'];//软件版本号[mcu]
                    }
                      
                    $softver = $arr['params']['softver'];
                    $hardver = $arr['params']['hardver'];//设备硬件版本号



                    $time = time();
                    $res = "insert into  sw_cycle(id,device_sn,electricity,temperature,humidity,concentration,time) values('','$device_sn','$electricity','$temperature','$humidity','$concentration','$time')";

                    $id =$conn->query($res);
                      

                    if($id){
                        $equip = "update sw_equipment set electricity='$electricity',temperature='$temperature',humidity='$humidity',time='$time',concentration='$concentration',lon='$lon',lat='$lat',devtype='$devtype',softver='$softver',hardver='$hardver',device_status = '$device_status',errno = '$errno' where  device_sn='$device_sn'";
                            $up =$conn->query($equip);
                            if($up){
                              echo '更新成功';
                            }
                    }



                }      
        }
    }
    
}

while (true) {
    get_redis();sleep(2);
}

//get_redis();