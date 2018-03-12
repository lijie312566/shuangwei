<?php
namespace Admin\Controller;
use Common\Controller\AdminBaseController;
/**
 * 后台首页控制器
 */
class SwuserController extends AdminBaseController{
	/**
	 * 客户列表页
	 */
	public function index(){
		$where['company_id'] = $_SESSION['user']['id'];
		$company = $this -> select_where_data('user',$where);
		p($company);
		$this->assign('data',$company);
		$this->display();
	}

//	上级登录
	public function login(){
		$map=I('post.');

		$username['username']=$map['username'];
		$user =$this->Entrance('user',$username);
		if(!empty($user)){

			$this->logina($map,'user');
		}
		$company =$this->Entrance('company',$username);
		if(!empty($company)){

			$this->logina($map,'company');
		}
	}
	public function logina($map,$table){
		$data=M($table)->where($map)->find();

		if (empty($data)) {
			$this->error('账号或密码错误');
		}else{
			$_SESSION['user']=array(
					'id'=>$data['id'],
					'front_username' => $_SESSION['user']['front_username'],
					'front_identity' => $_SESSION['user']['front_identity'],
					'user_username' =>  $_SESSION['user']['username'],
					'user_identity' =>  $_SESSION['user']['identity'],
					'front_status' =>  $_SESSION['user']['front_status'],
					'username'=>$data['username'],
					'identity' => $data['identity'],
					'user_status' => 3,
					'avatar'=>$data['avatar'],
					'email'=>$data['email'],
					'phone'=>$data['phone'],
					'ip'=>get_client_ip(1)
			);



			if($data['identity'] < $_SESSION['user']['user_identity']){
				unset ($_SESSION['user']['user_username']);
				unset ($_SESSION['user']['user_identity']);
				unset ($_SESSION['user']['user_status']);
			}
			$this->success('登录成功、前往管理后台',U('Admin/Index/index'));
		}
	}
	public function Entrance($table,$post){
		$data = M($table)->where($post)->select();
		return $data;
	}

}
