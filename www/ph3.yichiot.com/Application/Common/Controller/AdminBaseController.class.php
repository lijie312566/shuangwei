<?php
namespace Common\Controller;
use Common\Controller\BaseController;
/**
 * admin 基类控制器
 * 单眼皮
 */
class AdminBaseController extends BaseController{ 
	/**
	 * 初始化方法
	 */
	public function _initialize(){
		parent::_initialize();
		$auth=new \Think\Auth();
		$rule_name = MODULE_NAME.'/'.CONTROLLER_NAME.'/'.ACTION_NAME;
		$result=$auth->check($rule_name,$_SESSION['user']['id']);

		/*if(!$result){
			$this->error('您没有权限访问');
		}*/

        //导航调用
		$auth_rule = M('auth_rule')->where('pid=0')->select();
		foreach($auth_rule as $k => $v){
			$res=$auth->check($v['name'],$_SESSION['user']['id']);
			if($res != false){
				$e[$k]['title']=$v['title'];
				$e[$k]['name']=$v['name'];
				$where['pid'] = $v['id'];
				$where['state'] = 0;
				$line = M('auth_rule')->where($where )->select();
				$e[$k]['line'] = $line;
			}
		}
		
        //p($e);exit;
		$this->assign('auth_rule',$e);




      $user = $_SESSION['user'];
      if($user){

	  }else{
        $this->redirect('Home/Index/index');
   	  }
   	  
	}



     /**
      * 根据条件进行查询，条件为空查询全部
      * @param type $where
      * return type
      */
     public function select_where_data($table,$where = ''){
         if ($where == ''){
			 $data = M($table)->select();
         } else {
			 $data = M($table)->where($where)->select();

         }
		 return $data;
     }

     /**
      * 根据条件查询1条数据find()
      * @param type $where
      * return type
      */
     public function find_admin_where_data($table,$where = ''){
	     if($where == ''){
		     return false;
         }else{
			 $data = M($table)->where($where)->find();
         }

		 return $data;
     }

  /**
      * 增
      * @param type $data
      * return boolean
      */
     public function add_data($table,$data = array()){
	     if (empty($data)){
			 return FALSE;
         }
		 $dataadd = M($table)->add($data);
		 return $dataadd;
     }

    /**
      * 改
	  * $table 数据表
      * @param type $data 传入数据
      * @param type $where 传入条件
      * return boolean 影响的行数
      */
     public function save_where_data($table, $where = '',$data = array()) {
         if (empty($data)) {
	             return FALSE;
         }
         if (empty($where)) {
			 $user = M($table)->save($data);
         } else {
			 $user = M($table)->where($where)->save($data);
         }
		 return $user;
     }

	/**
	 * 改单一字段
	 * $table 数据表
	 * @param type $data 传入数据
	 * @param type $where 传入条件
	 * return boolean 影响的行数
	 */
	public function setField_where_data($table,$data = array(), $where = ''){
		if (empty($data)) {
			return FALSE;
		}
		if (empty($where)) {
			$user = M($table)->setField($data);
		} else {
			$user = M($table)->where($where)->setField($data);
		}
		return $user;
	}



	/**
	 * 查询单一字段
	 * $table  数据表
	 * $where  条件
	 * $field  字段
	 */
	public function getField_where_data($table,$where = '',$field){
		if($where == ''){
			return false;
		}else{
			$data = M($table)->where($where)->getField($field);
		}
		return $data;
	}
    
   


	/**
     *分页类
     *
     *
     */
	public function  getpage($table,$where = '',$limit,$url=''){
       $User = M($table); // 实例化User对象
       $count      = $User->where($where)->count();// 查询满足要求的总记录数
       //pp($url);
       $Page       = new \Think\Page($count,$limit);// 实例化分页类 传入总记录数和每页显示的记录数(25)
       $show       = $Page->show();// 分页显示输出
       // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
       $list = $User->where($where)->limit($Page->firstRow.','.$Page->listRows)->select();

    
	   //pp($show);
       $data['list'] = $list;
       $data['page'] = $show;
       return $data;

	}





}

