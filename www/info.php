<?php 
   //Connecting to Redis server on localhost 
   $redis = new Redis(); 
   $redis->connect('127.0.0.1', 6379); 
   


   // Get the stored data and print it 
   $arList = $redis->lrange("devicesdata", 0 ,100); 
    
   foreach($arList as $k=>$v){
       if(strpos($v,'imei')){
		$a=str_replace('<','',$v);
		$b=str_replace('>','',$a);
		echo $b.'</br>';
	}
} 
?>
