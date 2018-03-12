<?php
namespace Admin\Controller;
use Common\Controller\AdminBaseController;
/**
 * 后台首页控制器
 */
class CycleController extends AdminBaseController{


	/**
	 * 设备API
	 *arr所有的时间,  采集时间点
	 *
	 */
	
	// 找出数组中小于某个数的最大的元素
	protected function getMaxTime($arr, $time){
	    rsort($arr, SORT_NUMERIC );
	    $end = end($arr);
	    foreach($arr as $v){
	       if($v > $time){
	           if($v != $end){
	           	     continue;
               }else{
	               return 0;// 没有符合条件数据
               }
           }else{                                               
	           return $v;
           }
        }
    }


	public function index(){
		set_time_limit(0);
		ini_set("max_execution_time" , 0);



/*
$Y = 2016;//获取年，示例，真实环境从前端获取数据  
$m = 2;//获取月，示例，真实环境从前端获取数据  
$month = $Y."-".$m;//当前年月      
$month_start = strtotime($month);//指定月份月初时间戳  
$month_end = mktime(23, 59, 59, date('m', strtotime($month))+1, 00);//指定月份月末时间戳  



pp($month_end);*/









    //pp($_POST);
        if($_POST){
        	//判断查询的数据
 		  	$dw = $_POST['dw']; //pp($dw);
          	$unn= [''=>'temperature','0'=>'temperature','1'=>'humidity','2'=>'concentration','3'=>'co'];
          	$style = $unn[$dw];

            if($_POST['kuadu']=='week'){
	        	$start = I('param.starting_point', 0 , 'strtotime');// 查询开始时间
	        	//pp($start);
			    $end = I('param.end', 0, 'strtotime');// 查询结束时间
		    	$type = I('param.time', 2, 'intval');// 间隔单位，1 分,2时,3日,4星期,5月

		    	$step = I('param.interval', 0, 'intval');// 间隔
		        $unit = [1=>60, 2=>3600, 3=>3600*24 ,4=>3600*24*7];

		        $stepSeconds  = $step * $unit[$type];//查询的间隔时间戳



		        //pp($_POST['ids']);
		        $ids = explode(',',$_POST['ids']);    
		        
		        $map['device_sn'] =array('in',$ids);
		    
		        //$data = M('cycle')->where($map)->where(['time'=>['between', [$start, $end]]])->order('time')->field("device_sn,time,custom,$style")->select();
			    //$default = ['concentration'=>0,'electricity'=>0,'temperature'=>0,'humidity'=>0,'co'=>0,'custom'=>''];

		        $data= M('cycle')->where($map)->where(['time'=>['between', [$start, $end]]])->group("FLOOR(time/$stepSeconds)")->field("device_sn,time,custom,$style,FROM_UNIXTIME(time) as date")->select();

            }

	 //pp($data);
            if($_POST['kuadu']=='year'){
                $year = I('param.point');
                $first_month = I('param.point').'-01-01 00:00:00';
		    	$start =  strtotime($first_month);		
		    	$end = strtotime((I('param.point')+1).'-01-01 00:00:00');
          
		    	$step = I('param.interval',0,'intervals');
		    	//pp($step);
		    	$type = I('param.y_time',2,'intval');// 间隔单位   月
//pp($type);
                $ids = explode(',',$_POST['ids']);    
		        
		        $map['device_sn'] =array('in',$ids);
		    	//查询
		    	for($i=1;$i<=12;$i+=$step){
		    		$month = $year.'-'.$i;
		    		$month_start = strtotime($month);
		    		$month_end = mktime(23, 59, 59, date('m', strtotime($month))+1, 00);//指定月份月末时间戳  
		    		$stepSeconds = $month_end - $month_start;

		    		/*$data = M('cycle')->where($map)->where(['time'=>['between', [$month_start, $month_end]]])->order('time')->field("device_sn,time,custom,$style")->find();*/


		    		$data= M('cycle')->where($map)->where(['time'=>['between', [$start, $end]]])->group("FLOOR(time/$stepSeconds)")->field("device_sn,time,custom,$style,FROM_UNIXTIME(time) as date")->select();


		    	}
            }

		 //pp($data);
           

				//pp($data);
	        	$device = [];
		        foreach($data as $v ){

		            //$device[$v['device_sn']][$v['time']] = $v;  //把查询出的数据按设备编号---时间 重新组合

		            $list[$v['date']][$v['device_sn']] = $v;

		        }


               


				//pp($list);
		        //曲线展示的温度
		        foreach ($list as $time => $val) {
		        	//$time = date('Y-m-d H:i:s', $time);
		        	foreach ($val as $key => $value) {
		        		$temp[$key][] = intval($value['temperature']);
		        	}
		        }
			 	//pp($temp);
				$i = 0;
				foreach($temp as $k => $v){
					$wen[$i]['name'] = $k;
					$wen[$i]['data'] = $v;
					$i++;
				}			
				//pp($list);

			//曲线展示的湿度
				foreach ($list as $time => $val) {
		        	//$time = date('Y-m-d H:i:s', $time);
		        	foreach ($val as $key => $value) {
		        		$humidity[$key][] = intval($value['humidity']);
		        	}
		        }
	      
				$j = 0;
				foreach($humidity as $k => $v){
					$humi[$j]['name'] = $k;
					$humi[$j]['data'] = $v;
					$j++;
				}	



				//曲线展示的ph3
				foreach ($list as $time => $val) {
		        	//$time = date('Y-m-d H:i:s', $time);
		        	foreach ($val as $key => $value) {
		        		$concen[$key][] = intval($value['concentration']);
		        	}
		        }
	      

				$m = 0;
				foreach($concen as $k => $v){
					$con[$m]['name'] = $k;
					$con[$m]['data'] = $v;
					$m++;
				}	


               //曲线展示的co
				foreach ($list as $time => $val) {
		        	//$time = date('Y-m-d H:i:s', $time);
		        	foreach ($val as $key => $value) {
		        		$cc[$key][] = intval($value['co']);
		        	}
		        }
	      
				$n = 0;
				foreach($cc as $k => $v){
					$co[$n]['name'] = $k;
					$co[$n]['data'] = $v;
					$n++;
				}	
		       

				$arrayshift = reset($list);
				//建立session     
				$_SESSION['arrayshift']= $arrayshift;
				$_SESSION['data']= $list;
				//pp($wen);
				$_SESSION['temp']= $wen;
				$_SESSION['humi']= $humi;
				$_SESSION['con']= $con;
				$_SESSION['co'] = $co;
				 //pp($list);
				$this->assign('arrayshift',$arrayshift);
				//pp($list);
				$this->assign('data',$list);
				$this->assign('style',$style);
	           
				$this->display();
			

        }else{
        	$arrayshift = $_SESSION['arrayshift'];
        	$list = $_SESSION['data'];


        	$this->assign('arrayshift',$arrayshift); //pp($arrayshift);
			$this->assign('data',$list);  //pp($list);
			$this->display();
        }
	}

	//温度---湿度----气体浓度
	public function save(){
		$arrayshift = json_encode($_SESSION['arrayshift']);
		$list =json_encode( $_SESSION['data']);

		$style = $_GET['style'];

		if($style=='temperature'){
				$temp =json_encode( $_SESSION['temp']);
		}elseif($style=='humidity'){
				$temp =json_encode( $_SESSION['humi']);
		}elseif($style=='concentration'){
				$temp =json_encode( $_SESSION['con']);
		}else{
				$temp =json_encode( $_SESSION['co']);
		}

		$arr['arrayshift'] = $arrayshift;
		$arr['list'] = $list;
		$arr['temp'] = $temp;
		exit(json_encode($arr));
	}



	//存为表格的方法
	public function execl(){
		$arrayshift = $_SESSION['arrayshift'];
        $list = $_SESSION['data'];
        $style = $_GET['style'];
        //$wen = $_SESSION['temp'];
   		 $data['arr'] = $arrayshift;
   		 $data['list'] = $list;
   		 $data['style'] = $style;

     	if($style=='temperature'){
      		create_xls($data,温度数据统计);
      	}elseif($style=='humidity'){			
      		create_xls($data,湿度数据统计);
		}elseif($style=='concentration'){	
      		create_xls($data,ph3气体浓度数据统计);
		}else{
			create_xls($data,co气体浓度数据统计);
		}

	}

 

	public function add(){

		$this->display();
	}

	public function updateDevice(){
		$map=I('post.');
		$map['time']=time();
		$where['device_sn']=$map['device_sn'];//设备编码
		$data = $this -> find_admin_where_data('equipment',$where);

		if(empty($data)){
			$map['company_id']=500001;
			$this -> add_data('equipment',$map);
		}{
			$this ->save_where_data('equipment',$where,$map);
		}

		$this -> add_data('cycle',$map);
	}



}
