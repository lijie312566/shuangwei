<?php
namespace Home\Controller;
use Common\Controller\HomeBaseController;
/**
 * 商城首页Controller
 */
class IndexController extends HomeBaseController{
	/**
	 * 首页
	 */
	public function index(){
        if($_POST){
            // 做一个简单的登录 组合where数组条件 
            $map=I('post.'); //p($map);die;
            $map['password']=$map['password'];
            $username['username']=$map['username'];

            if($map['identity']==1){
                 $admin =$this->Entrance('admin',$username);
                 unset($map['identity']);
                if(!empty($admin)){
                    $this->logina($map,'admin');
                }else{
                    $this->error('该用户不存在');
                }
            }else if($map['identity']==2){
                 $company =$this->Entrance('company',$username);unset($map['identity']);
                if(!empty($company)){

                    $this->logina($map,'company');
                }else{
                    $this->error('该用户不存在');
                }

            }else if($map['identity']==3){// pp($map);
                $user =$this->Entrance('user',$username); unset($map['identity']);
                if(!empty($user)){

                    $this->logina($map,'user');
                }else{
                    $this->error('该用户不存在');
                }
           }else{

                $this->error('登录失败');
           }
           
           
        }else{
            $data=check_login() ? $_SESSION['user']['username'].'已登录' : '未登录';
            $assign=array(
                'data'=>$data
                );
            $this->assign($assign);
            $this->display();
        }
	}

    /**
     * 退出
     */
    public function logout(){
        session('user',null);
        $this->success('退出成功、前往登录页面',U('Home/Index/index'));
    }



    public function logina($map,$table){
        $data=M($table)->where($map)->find();//pp($data);
        if (empty($data)) {
            $this->error('账号或密码错误');
        }else{
            $_SESSION['user']=array(
                'id'=>$data['id'],
                'username'=>$data['username'],
                'identity'=>$data['identity'],
                'mail'=>$data['mail'],
                'phone'=>$data['phone'],
            );
            $this->success('登录成功、前往管理后台',U('Admin/Equipment/index'));
        }
    }
    
    public function Entrance($table,$post){
        $data = M($table)->where($post)->select();
        return $data;
    }

}

