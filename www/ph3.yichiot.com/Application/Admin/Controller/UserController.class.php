<?php
namespace Admin\Controller;
use Common\Controller\AdminBaseController;
/**
 * 用户列表
 */
class UserController extends AdminBaseController{

	/**
	 * 用户列表
	 */
	public function index(){
		$data=D('AuthGroupAccess')->getAllData();
       $assign=array(
           'data'=>$data
           );
        $this->assign($assign);

        $data = $this -> select_where_data('admin');
        $this->assign('data',$data);
        $this->display();
	}

    /***
    *添加下级用户
    */ 

    public function add(){

        if(IS_POST){
            $data=I('post.');
            $sess = $_SESSION['user']['identity'];
            $data['time'] = time();
              switch ($sess) {        
                    case '1':
                        $result=D('Company')->addData($data);
                        if($result){
                            $group=array(
                            'uid'=>$result,
                            'group_id'=>2
                            );
                            D('AuthGroupAccess')->addData($group);
                        }else{

                           echo '该用户已存在';
                        }

                      break;
                    case '2':
                    $data['company_id'] = $_SESSION['user']['id'];
                      $result=D('User')->addData($data);
                      if($result){
                        $group=array(
                            'uid'=>$result,
                            'group_id'=>3
                            );
                            D('AuthGroupAccess')->addData($group);
                          
                        }
                      break;      
              }

                // 操作成功
                $this->success('添加成功',U('Admin/Equipment/manage'));
        }else{
                $error_word=D('User')->getError();
                //
                //$this->error($error_word);
        }
        
    }
   /**
     * 验证该用户是否注册
     */

     public function check(){
        $username = $_GET['username'];
        $sess = $_SESSION['user']['identity'];
            switch ($sess) {        
                case '1':
                    $result=D('Company')->where(array('username'=>$username))->select();
                    if($result){
                         //pp($result);
                          //echo '11';
                          exit(json_encode(1));   
                    }else{
                        exit(json_encode(2));   
                    }

                  break;
                case '2':
                  $result=D('User')->where(array('username'=>$username))->select();
                  if($result){
                          exit(json_encode(1));   
                    }else{
                        exit(json_encode(2));   
                    }
                  break;      
            }
    }

    /*
    验证手机号是否存在
    */
    public function checktel(){
        $tel = $_GET['tel'];
        $sess = $_SESSION['user']['identity'];
        switch ($sess) {        
            case '1':
                $result=D('Company')->where(array('phone'=>$tel))->select();
                if($result){
                     //pp($result);
                      //echo '11';
                      exit(json_encode(1));   
                }else{
                    exit(json_encode(2));   
                }

              break;
            case '2':
              $result=D('User')->where(array('phone'=>$tel))->select();
              if($result){
                      exit(json_encode(1));   
                }else{
                    exit(json_encode(2));   
                }
              break;      
        }



    }





    /**
     * 添加管理员
     */
    public function add_user(){

        if(IS_POST){
            $data=I('post.');
               pp($data);
            if($data['group_ids'][0] == 1){
                $result=D('Admin')->addData($data);
            }elseif($data['group_ids'][0] == 2){
                $result=D('Company')->addData($data);
            }elseif($data['group_ids'][0] == 3){
                $result=D('User')->addData($data);
            }

           // $result=D('Users')->addData($data);

            if($result){
                if (!empty($data['group_ids'])){
                    foreach ($data['group_ids'] as $k => $v){
                        $group=array(
                            'uid'=>$result,
                            'group_id'=>$v
                            );

                        D('AuthGroupAccess')->addData($group);
                    }                   
                }
                // 操作成功
                $this->success('添加成功',U('Admin/User/index'));
            }else{
                $error_word=D('User')->getError();
                //
                $this->error($error_word);
            }
        }else{
            $data=D('AuthGroup')->select();

            $assign=array(
                'data'=>$data
                );
            foreach($data as $key => $value){
                if(!in_array($_SESSION['user']['identity']+1,$value)) unset($data[$key]);
            }
            $this->assign('dataa',$data);
            $this->assign($assign);
            $this->display();
        }
    }


    /**
     * 修改管理员
     */
    public function edit_user(){

        if(IS_POST){

            $data=I('post.');

            // 组合where数组条件
            $uid=$data['id'];

            $map=array(
                'id'=>$uid
                );
            // 修改权限

            D('AuthGroupAccess')->deleteData(array('uid'=>$uid));
            foreach ($data['group_ids'] as $k => $v){
                $group=array(
                    'uid'=>$uid,
                    'group_id'=>$v
                    );
                D('AuthGroupAccess')->addData($group);
            }
            $data=array_filter($data);
            // 如果修改密码则md5
            if (!empty($data['password'])){
                $data['password']=md5($data['password']);
            }
           //  p($data);die;



            $result=D('Admin')->editData($map,$data);
            if($result){
                // 操作成功
                $this->success('编辑成功',U('Admin/User/index',array('id'=>$uid)));
            }else{
                $error_word=D('Users')->getError();
                if (empty($error_word)){
                    $this->success('编辑成功',U('Admin/User/index',array('id'=>$uid)));
                }else{
                    // 操作失败
                    $this->error($error_word);                  
                }

            }
        }else{
            $id=I('get.id',0,'intval');
            // 获取用户数据

            $where['id']=$id;
            $user_data= $this -> find_admin_where_data('admin',$where);
            // 获取已加入用户组
            $group_data=M('AuthGroupAccess')
                ->where(array('uid'=>$id))
                ->getField('group_id',true);
            // 全部用户组
            $data=D('AuthGroup')->select();
            $assign=array(
                'data'=>$data,
                'user_data'=>$user_data,
                'group_data'=>$group_data
                );

            $this->assign($assign);
            $this->display();
        }
    }


    /*个人中心*/    /*分开写是为了将权限更细化*/
    public function my_center(){
        $this->display();
    }

    /*修改个人资料*/
    public function change_msg(){
        if(IS_POST){
          // pp($_POST);
            $data['username']  =  trim(I('post.username'));
            $data['mail']  =  trim(I('post.mail'));
            $data['phone']=trim(I('post.phone'));
            $data['custom']=trim(I('post.custom'));
            $data['password']=trim(I('post.password'));
            trace("&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&");
            trace($data);
            $map=array(
                'username'=>session('user')['username']
                );
            if (!empty(I('post.password'))){
                $data['password']=I('post.password');
            }
            $result=D('User')->where($map)->save($data);

            if($result){
                // 操作成功
                //session('user',null);
                $this->success('添加成功',U('Admin/Equipment/manage'));
            }else{
                $this->error("您没有做任何修改");   
            }
        }
    }


}
