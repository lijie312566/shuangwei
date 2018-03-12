<?php
namespace Admin\Controller;
use Common\Controller\AdminBaseController;
/**
 * 文章
 */
class ArticleController extends AdminBaseController{
    /**
     * 文章列表
     */
    public function index(){
    	$data=D('Article')->where('del=0')->order('create_time desc')->page($_GET['p'].',10')->limit(10)->select();
		$count      = D('Article')->where('del=0')->count();
		$Page       = new \Think\Page($count,10);
		$show       = $Page->show();
		$this->assign('data',$data);
		$this->assign('page',$show);
    	$this->display();
    }


    //附带时间限制新增文章
    public function add_art(){
    	if($_POST){
    		if (session('user')['username']=='admin') {
    			$data['title']  =  trim(I('post.title'));
	            $data['abstract']  =  trim(I('post.abstract'));
	            $data['content']  =  trim(I('post.content'));
	            $data['create_time']=date("Y-m-d H:i:s",time());
	            $data['author']=session('user')['username'];
	            $result=D('Article')->add($data);
	            if ($result) {
		            $this->success('添加成功',U('Admin/Article/index'));
		        }else{
		            $this->error('添加失败');
		        }
		        exit;
    		}else{
	    		$user=session('user')['username'];
	    		$map=array(
	    			'author'=>$user,
	    			'del'=>0,
	    			);
	    		$datas=D('Article')->where($map)->order('create_time desc')->find();
	    		$lastadd=strtotime($datas['create_time']);
	    		if ((time() - $lastadd)<=60) {
	    			echo "<script> alert('一分钟内禁止重复发布信息');location.href='../Article/index';</script>";
	    		}else{
	    			$data['title']  =  trim(I('post.title'));
		            $data['abstract']  =  trim(I('post.abstract'));
		            $data['content']  =  trim(I('post.content'));
		            $data['create_time']=date("Y-m-d H:i:s",time());
		            $data['author']=$user;
		            $result=D('Article')->add($data);
		            if ($result) {
			            $this->success('添加成功',U('Admin/Article/index'));
			        }else{
			            $this->error('添加失败');
			        }
			        exit;
	    		}
    		}
    	}
    	$this->display();
    }

    // //没有时间限制新增文章
    // public function add_art(){
    // 	if($_POST){
    // 		// echo "<script> alert('一分钟内禁止重复发布信息');location.href='../Article/index';</script>";
    // 		$data['title']  =  trim(I('post.title'));
    //         $data['abstract']  =  trim(I('post.abstract'));
    //         $data['content']  =  trim(I('post.content'));
    //         $data['create_time']=date("Y-m-d H:i:s",time());
    //         $data['author']=session('user')['username'];
    //         $result=D('Article')->add($data);
    //         if ($result) {
	   //          $this->success('添加成功',U('Admin/Article/index'));
	   //      }else{
	   //          $this->error('添加失败');
	   //      }
	   //      exit;
    // 	}
    // 	$this->display();
    // }

    //删除文章
   public function del_art(){
        $map=array(
            'id'=>I('get.id')
        );
        $result=D('Article')->where($map)->save(array('del'=>1));
        if($result){
            $this->success('删除成功',U('Admin/Article/index'));
        }else{
            $this->error('删除失败');
        }
   }


   //文章编辑
    public function edi_art(){
	   	if($_POST){
	        $data['title']  =  trim(I('post.title'));
            $data['abstract']  =  trim(I('post.abstract'));
            $data['content']  =  trim(I('post.content'));
            $data['create_time']=date("Y-m-d H:i:s",time());
	        // 组合where数组条件
	        $map['id']  =  trim(I('post.id'));
	        trace($map);
	        $result=D('Article')->where($map)->save($data);
	        if($result){
	            // 操作成功
	            $this->success('编辑成功',U('Admin/Article/index'));
	        }else{
	            
	            $this->error("编辑失败");                  
            }
	    }else{
	        $id=I('get.id');
	        // 获取用户数据
	        $data=M('Article')->find($id);
	        trace($data);
	        $this->assign('data',$data);
	        $this->display();
	    }
    }

}