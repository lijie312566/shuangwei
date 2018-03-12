<?php
namespace Admin\Controller;
use Common\Controller\AdminBaseController;


//include  __THINKPHP__ .'/Library/Think/Autoloader.php';

// use Workerman\Autoloader;
// use Workerman\Worker;
/**
 * 设备列表页  
 */
class EquipmentController extends AdminBaseController{
	
    //判断用户身份,进入不同的列表页
    public function index(){

       /* $ii = iconv('UTF-8','BIG5','测试');
        var_dump($ii) ;die;*/
        $user = $_SESSION['user'];
        $where = '1=1';
        $wherelist = array();
        $type = 'temperature';
        if($_GET){ 
            $post = $_GET;  //pp($post);
            $limit = $post['limit']; //p($limit);
            $unit = [1=>'>', 2=>'<', 3=>'='];
            $size = $unit[$limit];

            $nn =['<'=>'lt' ,'>'=>'gt','='=>'eq'];
            $sizes = $nn[$size];
            

          $dw = $post['dw']; //pp($dw);
          $unn= [''=>'temperature','0'=>'temperature','1'=>'humidity','2'=>'concentration','3'=>'co'];
          $type = $unn[$dw];

            $where = '1=1';
           if(!empty($post['device_sn'])){
              /*$where['device_sn']= array('like',$post['device_sn']);*/
              $where .= " and device_sn like '%$post[device_sn]%'";
             $wherelist[] ="device_sn=".$post['device_sn'];
              //$wherelist['device_sn'] = $post['device_sn'];
           }

            if(!empty($post['custom'])){
              /*$where ['custom'] = array('like',$post['custom']);*/
                $where .= " and custom like  '%$post[custom]%'";
               $wherelist[] = "custom = ".$post['custom'];
                //$wherelist['custom'] = $post['custom'];
            }

            if(!empty($post['device_status'])){
                if($post['device_status']!='请选择'){
                    //pp($post['device_status']);
                    $where .=" and device_status='$post[device_status]' ";
                   $wherelist[] = "device_status =".$post['device_status'];
                    //$wherelist['device_status'] = $device_status;
                }
            }

           if($post['range']!=''){
              /*$where["$type" ] = array("$size",$post['range']);*/
              $where .=" and $type $size $post[range] ";
              $wherelist[] = "$type $size $post[range]";
              //$wherelist["$type"] = array("$sizes",$post['range']);
             
           }
           //pp($wherelist);
           if(count($wherelist)>0){
              $url = '&'.implode('&',$wherelist);
           }
          //pp($url);
        }
       // pp($wherelist);
           $exist['company_id'] = $_SESSION['user']['id'];
    		//$where['company_id'] = $_SESSION['user']['id'];
            $id = $_SESSION['user']['id'];
    		if($_SESSION['user']['identity']==1){

    			$equipment = $this -> getpage('equipment',$where,10,$url);  //pp($equipment);
                $user = D('User')->field('id,username')->select();
                //pp($equipment);
		    }else{

                $where['company_id'] = $_SESSION['user']['id'];
			    $equipment = $this -> getpage('equipment',$where,10,$url);
                $user = D('User')->field('id,username')->where(array('company_id'=>$id,'status'=>0))->select();

		    }

    		if($_SESSION['user']['identity'] == 3){
                $w['id'] = $_SESSION['user']['id'];
    			$username = $_SESSION['user']['username'];
               
                $id = $w['id'];
                //根据user表查出设备id
    			$getField = $this -> getField_where_data('user',$w,'equipment_id');
    			$data['id'] = array('in',$getField);
                //查询设备id
    			$equipment = $this -> getpage('equipment',$data,10,$url='');
                $user = array(array('id' =>$id ,'username'=> $username));
		    }


            //pp($equipment);当直接搜地址进来时无数据，因为没有身份
      		$this->assign('user',$user);
      		$this->assign('data',$equipment);
            //pp($type);
            $this->assign('style',$type);
      		$this->display();
    }


    //高德地图转成百度地图
    function bd_encrypt($gg_lon,$gg_lat)
    {
            $x_pi = 3.14159265358979324 * 3000.0 / 180.0;
            $x = $gg_lon;
            $y = $gg_lat;
            $z = sqrt($x * $x + $y * $y) - 0.00002 * sin($y * $x_pi);
            $theta = atan2($y, $x) - 0.000003 * cos($x * $x_pi);
            $data['bd_lon'] = $z * cos($theta) + 0.0065;
            $data['bd_lat'] = $z * sin($theta) + 0.006;
            return $data;
    }


	//地图
	public function map(){
       if($_GET){
            //echo '111';die;
                $dw = $_GET['dw'];
                $unn = [''=>'temperature','0'=>'temperature','1'=>'humidity','2'=>'concentration','3'=>'co'];
                $type = $unn[$dw];

                $device_sn=$_GET['device_sn'];
                $data = D('Equipment')->where("device_sn='$device_sn'")->select();  //pp($data);
                $data[0]['cycle_time'] = $this->Sec2Time($data[0]['cycle_time']);   
                //$data[0]['type'] = $type;         
                //位置
                $ku_id = $data[0]['warehouse_id'];
                $ku =D('Warehouse')->where("id = $ku_id")->getField('name');  

                //区
                unset($data[0]['warehouse_id']);
                $data[0]['warehouse'] = $ku;
                $data[0]['floor'] = $data[0]['floor_id'];

                //地图
               $arr = $this->bd_encrypt($data[0]['lon'],$data[0]['lat']);
               $data[0]['lon'] = $arr['bd_lon'];
               $data[0]['lat'] = $arr['bd_lat'];


               //温度  ,湿度
               $data[0]['temperature'] = $data[0]['temperature'];
               $data[0]['humidity'] = $data[0]['humidity'];

               //pp($data);
                $this->assign('data',$data);


                //所有的库
                $warehouse = D('Warehouse')->select(); //pp($warehouse);
                $this->assign('warehouse',$warehouse);
                $this->assign('style',$type);
                $this->assign('dw',$dw);
                $this->display();
            
        }else{           
            $type = 'temperature';
            $data[] = D('Equipment')->find();//pp($data);
        
              $arr = $this->bd_encrypt($data[0]['lon'],$data[0]['lat']);
               $data[0]['lon'] = $arr['bd_lon'];
               $data[0]['lat'] = $arr['bd_lat'];


               //温度  ,湿度
               $data[0]['temperature'] = ($data[0]['temperature']/10)-273;
               $data[0]['humidity'] = $data[0]['humidity']/10;

            $this->assign('data',$data);
             $this->assign('dw',0);
            $this->assign('style',$type);
            $this->display();
        }     
	}

  
    public function getfloor(){
        $id = $_GET['warehouse_id'];
        //该库下面的层
        $floor  = D('Warehouse')->where("id =$id")->getField('total_floor'); //pp($floor); 
        exit(json_encode($floor)); 
        /*$floor = intval($floor);  //pp($floor);              
        $this->assign('floor',$floor);
        $this->display('map');*/
    }
     

  //地理
  public function map2(){
       if($_GET['device_sn']){
            $dw = $_GET['dw'];
            $unn = [''=>'temperature','0'=>'temperature','1'=>'humidity','2'=>'concentration','3'=>'co'];
            $type = $unn[$dw];


            $device_sn=$_GET['device_sn'];
            $data = D('Equipment')->where("device_sn='$device_sn'")->select();  //pp($data);
            $data[0]['cycle_time'] = $this->Sec2Time($data[0]['cycle_time']);  

            $ku_id = $data[0]['warehouse_id'];
            $ku =D('Warehouse')->where("id = $ku_id")->getField('name');  //pp($ku); 
                
            //区
            $data[0]['warehouse'] = $ku;
            $data[0]['floor'] = $data[0]['floor_id'];

            $this->assign('data',$data);      //pp($data);

              //设备所在库的楼层数,每层楼的数量             
            //楼层
            $total_floor = D('Warehouse')->where("id = $ku_id")->getField('total_floor');
            //$this->assign('total_floor',$total_floor);//pp($total_floor);

            //查出该库区下的所有楼层设备
            $info = D('Equipment')->field('device_sn,floor_id')->where("warehouse_id = $ku_id")->select(); //pp($info);
            $this->assign('info',$info);


            $list=array();
            for($i=1;$i<$total_floor+1;$i++){
                foreach ($info as $key => $value) {
                    if($i==$value['floor_id']){
                        $list[$i] ['num']+=1;
                        $list[$i]['device_sn'][] = $value['device_sn'];
                    }else{
                        $list[$i][] = $i;
                    }
                } 
            }

            //所有的库
            $warehouse = D('Warehouse')->select(); //pp($warehouse);
            $this->assign('warehouse',$warehouse);
      

            $this->assign('list',$list);
            $this->assign('dw',$dw);
            $this->assign('style',$type);


            $this->display();
        }else{           
            $data[] = D('Equipment')->find();//pp($data);
            $this->assign('data',$data);
            $this->display();
        }       
  }

    //根据当前设备,显示出设备信息
    public function  information(){
        $device_sn = $_GET['device_sn'];
        $info = M('equipment')->where("device_sn = '$device_sn'")->find();
        //区
        $warehouse_id = $info['warehouse_id'];
        $ku =D('Warehouse')->where("id = $warehouse_id")->getField('name'); 
           
        $info['warehouse'] = $ku;

        //pp($info);
        exit(json_encode($info));
    }


    //修改库区名称
    public function uphouse_name(){
        $house_name =$_GET['order'];
        $house_id = $_GET['house_id'];
        $data['name'] = $house_name;
        $change = M('Warehouse')->where("id = '$house_id' ")->save($data);
       if($change){
          exit(json_encode(11));
       }




    }


   //时间转换方法
    function Sec2Time($time){
        if(is_numeric($time)){
          $value = array(
            "hours" => 0,
            "minutes" => 0, 
            "seconds" => 0,
          );
        
          if($time >= 3600){
            $value["hours"] = floor($time/3600);
            $time = ($time%3600);
          }
          if($time >= 60){
            $value["minutes"] = floor($time/60);
            $time = ($time%60);
          }
            $value["seconds"] = floor($time);

            $t= $value["hours"] ."小时". $value["minutes"] ."分".$value["seconds"]."秒";
            Return $t;
        
        }else{
            return (bool) FALSE;
        }
    }


	//系统管理
    public function manage(){
   		$sess = $_SESSION['user']['identity'];
   		$id = $_SESSION['user']['id'];
        switch ($sess) {        
            case '1':
                $result=D('Company')->where('status=0')->select(); //pp($result);
                  $this->assign('data',$result);
                  $this->display();
                break;
            case '2':
              $result=D('User')->where(array('company_id'=>$id,'status'=>0))->select();// pp($result);
              //查询出管理人员的上限
              $user_topnum = D('Company')->where(array('id'=>$id,'status'=>0))->getField('user_topnum');
              $count=D('User')->where(array('company_id'=>$id,'status'=>0))->count();// 
              

                $this->assign('data',$result);
                $this->assign('user_topnum',intval($user_topnum));
                $this->assign('count',intval($count));


                $this->display('manage_company');
              //$sheng =3;
              break;   
            case '3':
              $result=D('User')->where(array('id'=>$id,'status'=>0))->find();// pp($result);
                $this->assign('data',$result);
                $this->display('manage_user');
              break; 
              
        }      
    }
    

    //获取一个用户的管理人数,设备数
    public function checknum(){
      $id = $_GET['id'];
      $user_num = M('user')->where("company_id = '$id'")->count();
      $device_num = M('equipment')->where("company_id = '$id'")->count();

      $num['user_num']=$user_num;
      $num['device_num'] = $device_num;

      exit(json_encode($num));

    }

 
    //获取一个用户的信息
    public  function getone(){
    	$id =$_GET['id'];
        $sess = $_SESSION['user']['identity'];
        switch ($sess) {        
                case '1':
                    $result=D('Company')->where(array('id'=>$id))->find(); //pp($result);
                    break;
                case '2':
                  $result=D('User')->where(array('id'=>$id))->find();// pp($result);
                  break;      
        }
         //pp($result);
        exit(json_encode($result));
    }


    //删除维修工/客户
    public function stopuser(){
    	$id =$_GET['id'];
      $sess = $_SESSION['user']['identity'];
      $data['status'] = '1';
        switch ($sess) {        
                case '1':
                    //如果客户被删除,维修工也删除
                    $result=D('Company')->where(array('id'=>$id))->save($data); //pp($result);
                    $result=D('User')->where(array('company_id'=>$id))->save($data);
                    break;
                case '2':
                  $result=D('User')->where(array('id'=>$id))->save($data);// pp($result);
                  break;      
        }

        if($result){
        	  exit(json_encode(1));
        }
    }

    //修改维修工
    public function upuser(){
       $get = $_GET;
       $id = $get['id'];

       $get['time'] = time();
 		   $sess = $_SESSION['user']['identity'];
        switch ($sess) {        
                case '1':
                    $result=D('Company')->where(array('id'=>$id))->save($get);                 
                    break;
                case '2':
                  $result=D('User')->where(array('id'=>$id))->save($get);
                  //$sheng =3;
                  break;                
        }


       if($result){
       		 $this->success('修改成功',U('Admin/Equipment/manage'));

       }

    }

	//添加设备
	public function dataadd(){
		$map=I('post.');
   //pp($map);
		/*if(!empty($map['user_id'])){
			$map['telephone'] = implode(",", $map['user_id']);
		}*/
		$map['time'] = time();
    $map['telephone'] = $map['user_id'];
    $user_id = intval($map['user_id']);//pp($user_id);

    $sess = $_SESSION['user']['identity'];
        switch ($sess) {        
                case '1': //如果是admin,根据user_id查出他所在的公司
                  
                     $result=D('User')->where(array('id'=>$user_id))->getField('company_id');

                     //pp($result);  
                    $map['company_id'] = intval($result);
                    unset($map['user_id']);             
                    break;
                case '2': 
		              $map['company_id'] = $_SESSION['user']['id'];
                  unset($map['user_id']);
                case '3'://如果是维护工
                  $result=D('User')->where(array('id'=>$user_id))->getField('company_id');
                   //pp($result);  
                    $map['company_id'] = intval($result);
                    unset($map['user_id']); 
                  break;                
        }


		$data = $this -> add_data('equipment',$map);

		/*if(!empty($map['user_id'])){
			$telephone['id'] = array('in',$map['telephone']);
			$getfield = $this ->select_where_data('user',$telephone);
			foreach($getfield as $k => $v){
				$where['id'] = $v['id'];
				if(!empty($v['equipment_id'])){
					$telep['equipment_id'] = $v['equipment_id'].','.$data;
				}else{
					$telep['equipment_id'] = $data;
				}
				$this -> save_where_data('user',$where,$telep);
			}
		}
*/
    if(!empty($map['telephone'])){
       $telephone['id'] = $map['telephone'];
       $getfield = $this -> select_where_data('user',$telephone);
      foreach($getfield as $k => $v){
        $where['id'] = $v['id'];
        if(!empty($v['equipment_id'])){
          $telep['equipment_id'] = $v['equipment_id'].','.$data;
        }else{
          $telep['equipment_id'] = $data;
        }
        $user = $this -> save_where_data('user',$where,$telep);
      }
    }

		if($data&&$user){
			$this->success('添加设备成功','index');
		}else{
			$this->error('新增失败');
		}
	}


   //修改设备
   public function update(){
        if($_POST){
                $post = $_POST; //pp($post);
                $device_sn = $post['device_sn'];
                $post['cycle_time'] = $post['cycle_time']*$post['stime'];
                 //pp($post);
                $post['warehouse_id'] = intval($post['warehouse_id']);
                $post['floor_id'] = intval($post['floor_id']);
                 // $post['floor_limit'] = intval($post['floor_limit']);
                 // $post['warehouse_limit'] = intval($post['warehouse_limit']);
                $supply = $_FILES['supply'];
              //pp($supply);
                if(!empty($supply)){
                  $info = equip_upload($supply);

                    if($info){            
                      $post['supply'] = $info;
                    }
                }
              
                unset($post['stime']);
                unset($post['device_sn']);
             
                // pp($device_sn);
                $res = D('Equipment')->where(array('device_sn'=>$device_sn))->save($post);
                //pp($res);
               
                $info = D('Equipment')->where(array('device_sn'=>$device_sn))->find();

                //pp($info);
            //给设备发送信息
            $send['prd'] = $post['cycle_time'];  

            //PH3
          
                $send['lhs'] =  $info['con_upper_limit'];    //上限
                $send['lls'] =   $info['con_buttom_limit'];   //下
          

            //温度
           
                $send['lht'] =  (intval($info['tem_upper_limit'])+273)*10;  //上
                $send['llt'] =  (intval($info['tem_buttom_limit'])+273)*10;   //下
         

            //湿度
           
                $send['lhh'] =  intval($info['humi_upper_limit'])*10;  //上
                $send['llh'] =  intval($info['humi_buttom_limit'])*10;   //下
         

                $send['m'] = "ConfigDevice";
                $send['imei'] = $device_sn;
                //pp($send);
                $dev_post = $this->getpost($send);
                $dev = (array)(json_decode($dev_post));
//pp($dev);
                if($res&&($dev['status']==1)){
                    $this->success('设置成功');
                }else{
                    $this->error('设置失败');
                }

        }

    }


    function getpost($send){
        //初始化
        $curl = curl_init();
        //设置抓取的url
        curl_setopt($curl, CURLOPT_URL, 'http://ph3.yichiot.com/w.php');
        //设置头文件的信息作为数据流输出
        curl_setopt($curl, CURLOPT_HEADER, 0);
        //设置获取的信息以文件流的形式返回，而不是直接输出。
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        //设置post方式提交
        curl_setopt($curl, CURLOPT_POST, 1);
        //设置post数据
       
         $post_data = $send;
        curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
        //执行命令
         $data = curl_exec($curl);
        //关闭URL请求
         curl_close($curl);
         //显示获得的数据
         return $data;
    }





    // 针对uid推送数据
    function sendMessageByUid($uid, $message)
    {
        global $worker;
        if(isset($worker->uidConnections[$uid]))
        {
            $connection = $worker->uidConnections[$uid];
            $connection->send($message);
        }
    }

    //当客户端连接上来时分配uid,并保存连接,并通知所有客户端
    function handle_connection($connection)
    {
        global $text_worker,$global_uid;
        $connection->uid = ++$global_uid;
    }


    // 当客户端发送消息过来时,转发给所有人
    function handle_massage($connection , $data)
    {
        global $text_worker;
        foreach ($text_worker as $connections => $conn) {
            


        }
    }


   /* 
   function upload($data){
            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize   =     3145728 ;// 设置附件上传大小
            $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg','txt');// 设置附件上传类型
            $upload->rootPath  =      './Public/Uploads/'; // 设置附件上传根目录
            $upload->savePath  =      ''; // 设置附件上传（子）目录
            // 上传文件 
            $info   =   $upload->upload($data);
            if(!$info) {// 上传错误提示错误信息
                $this->error($upload->getError());
            }else{// 上传成功 获取上传文件信息
                foreach($info as $file){
                    echo $file['savepath'].$file['savename'];
                }
            }
    }*/


    //升级版本号
    public function upsoft(){
        //pp($_POST);
        $url = $_POST['url'];
        $ban_number = $_POST['ban_number'];

        $data['url'] = $url;
        $data['version'] = $ban_number;
        $data['m'] = "UpdateSoft";



        $dev_post = $this->getpost($data);
       //echo $dev_post;die;
        $dev = (array)(json_decode($dev_post));
       //pp($dev);
        if($dev['status']==1){
            $this->success('升级成功');
        }else{
            $this->error('升级失败');
        }

    }


      
    


}
