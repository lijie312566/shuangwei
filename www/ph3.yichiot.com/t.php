<?php
    //实例化redis
    $redis = new Redis();
    //连接
    $redis->connect('127.0.0.1', 6379);
    //列表
    //存储数据到列表中
    //$redis->lpush('list', 'html');
    //$redis->lpush('list', 'css');
    //$redis->lpush('list', 'php');
    //$redis->lpush('list', 'mysql');
    //$redis->lpush('list', 'javascript');
    //$redis->lpush('list', 'ajax');

    //获取列表中所有的值
    $list = $redis->lrange('list', 0, -1);
    print_r($list);echo '<br>'; 

    //获取列表的长度
    $length = $redis->lsize('list');
    echo $length;echo '<br>';
	
	$list = $redis->lrange("list",0,3);
	print_r($list);echo '<br>'; 
	
	//$list = $redis->lpop('list');
    //print_r($list);echo '<br>'; 

    //获取列表的长度
    $length = $redis->lsize('list');
    echo $length;echo '<br>';
	
	//获取列表中所有的值
    //$list = $redis->lrange('list', 0, 3);
    //print_r($list);echo '<br>'; 

    