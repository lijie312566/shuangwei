<?php
namespace Admin\Controller;
use Common\Controller\AdminBaseController;
/**
 * 登录
 */
class CompanyController extends AdminBaseController{
	/**
	 * 
	 */
	public function index(){
		$company = $this -> select_where_data('company');
		$this->assign('data',$company);
		$this->display();
	}

   //登录
	public function login(){
		if($_GET){
          	$map = $_GET;
		}else{
			$map=I('post.');
		}

		$username['username']=$map['username'];
		
		$admin =$this->Entrance('admin',$username);
		if(!empty($admin)){
			$this->logina($map,'admin');
		}

		$company =$this->Entrance('company',$username);
		if(!empty($company)){
			$this->logina($map,'company');
		}

		$user =$this->Entrance('user',$username);
		if(!empty($user)){

			$this->logina($map,'user');
		}

		
	}

    //建立session
	public function logina($map,$table){
		$data=M($table)->where($map)->find();


		if (empty($data)) {
			$this->error('账号或密码错误');

		}else{
			$_SESSION['user']=array(
					'id'=>$data['id'],
					'username'=>$data['username'],
					'front_username' => $_SESSION['user']['username'],
					'front_identity' => $_SESSION['user']['identity'],
					'identity' => $data['identity'],
					'front_status' => 2,
					'avatar'=>$data['avatar'],
					'email'=>$data['email'],
					'phone'=>$data['phone'],
					'ip'=>get_client_ip(1)
			);

			if($data['identity'] < $_SESSION['user']['front_identity']){
				unset ($_SESSION['user']['front_username']);
				unset ($_SESSION['user']['front_identity']);
				unset ($_SESSION['user']['front_status']);
			}
			$this->success('登录成功、前往管理后台',U('Admin/Index/index'));
          
		}
	}


	public function Entrance($table,$post){
		$data = M($table)->where($post)->select();
		return $data;
	}


}
