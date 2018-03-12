<?php 
   //Connecting to Redis server on localhost 
   $redis = new Redis(); 
   $redis->connect('127.0.0.1', 6379); 
   
$str='<{
"imei": "865701234567890", "cmd": "tick",
"index": 12,
"params": {
"devtype": "LHQ", //设备类型 "hardver": 201, //设备硬件版本号
"usoftver": 102, "dsoftver": 101, "count": 1, "datas": [
//软件版本号【MC20】 //软件版本号【mcu】 //数据体条数
//数据集
} ]
{
//温度 "unit": "C"
},
"humidity": { //湿度
"value": 35.3,
"unit": "%" },
"sensor": { //传感器数据 "value": 123,
"tempe": { "value": 23.5,
"unit": "ppm" },
"time": 134567890
//数据记录时间的 unix 时间戳
} }>';
$str=substr($str,1);
$str=substr($str, 0, -1);

$a=json_encode($str);
echo print_r($a);
exit; 

echo "Connection to server sucessfully"; 
   //store data in redis list 
   $redis->lpush("tutorial-list", "Redis"); 
   $redis->lpush("tutorial-list", "Mongodb"); 
   $redis->lpush("tutorial-list", "Mysql");  

   // Get the stored data and print it 
   $arList = $redis->lrange("tutorial-list", 0 ,5); 
   echo "Stored string in redis:: "; 
   print_r($arList); 
?>
