<?php
namespace Admin\Controller;
use Common\Controller\AdminBaseController;
/**
 * 后台首页控制器
 */
class CycleController extends AdminBaseController{


//	public function __construct(){
//
//	}
	/**
	 * 设备API
	 */



	public function index(){
		p($_POST);

		$map['time'] = array(array('egt',strtotime($_POST['starting_point'])),array('elt',strtotime($_POST['end'])),'AND');

		$cycle = $this->select_where_data('cycle',$map);


		$starting_point = strtotime($_POST['starting_point']);//开始时间


		foreach($cycle as $k => $v){

			$a=array();
			for($i=0;$i<count($cycle);$i++){

				if($starting_point < $v['time'] && $v['time'] < $starting_point+300){
					$a[] = $starting_point+300;
				}

			}
		}

		p($a);


//		$dt=$_POST['starting_point'];
//		$b=1;
//		$cy = array();
//		$a = array();
//		for($i=0;$i<=10;$i=$i+$b){
//			$where['time'] = strtotime(date('Y-m-d H:i:s',strtotime("$dt+$i minute")));
//			$cy[] = $this->select_where_data('cycle',$where);
//			$a[]=date('Y-m-d H:i:s',strtotime("$dt+$i minute"));
//		}
//		p($a);


		$cycle = $this->select_where_data('cycle');
		$this->assign('data',$cycle);
		$this->display();
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
		}else{
			$this ->save_where_data('equipment',$where,$map);
		}

		$this -> add_data('cycle',$map);
	}






}
