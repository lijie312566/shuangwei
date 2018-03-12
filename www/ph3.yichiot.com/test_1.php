<?php




function  get_redis(){
   //Connecting to Redis server on localhost
   $redis = new Redis();
   $redis->connect('127.0.0.1', 6379);


   // Get the stored data and print it
   $arList = $redis->lrange("devicesdata", 0 ,100);


$conn=new mysqli('47.95.192.25','sw_dba','sw2017','sw','3306');  
if(!$conn){  
    die('数据库打开失败');  
}else{
  echo '连接成功';
}  

$uid = $redis->lrange("uid",0,100);
//var_dump($arList);
var_dump($uid);die;




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

                    $device_sn=''; $electricity='';  $temperature=''; $humidity='';  $time='';
                      $device_sn =$arr['imei']; 


                      $electricity =$arr['params']['voltage']; 
                      $temperature =($arr['params']['tempe']/10)-273; 
                      $humidity =($arr['params']['humidity']/10); 

                      $concentration = $arr['params']['sensor'];

                      $lon = $arr['params']['lon'];
                      $lat = $arr['params']['lat'];

                      $devtype = $arr['params']['devtype'];//设备类型


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

                }      
        }
    }
    if($id){
      $equip = "update sw_equipment set electricity='$electricity',temperature='$temperature',humidity='$humidity',time='$time',concentration='$concentration',lon='$lon',lat='$lat',devtype='$devtype',softver='$softver',hardver='$hardver' where  device_sn='$device_sn'";
          $up =$conn->query($equip);
          if($up){
            echo '更新成功';
          }
    }
}

while (true) {
    get_redis();sleep(2);
}