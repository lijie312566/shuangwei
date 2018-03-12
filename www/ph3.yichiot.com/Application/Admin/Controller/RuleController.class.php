<?php
namespace Admin\Controller;
use Common\Controller\AdminBaseController;
/**
 * 后台权限管理
 */
class RuleController extends AdminBaseController{

//******************权限***********************
    // /**
    //  * 权限列表
    //  */
    // public function index(){
    //     $data=D('AuthRule')->getTreeData('tree','id','title');
    //     $assign=array(
    //         'data'=>$data
    //         );
    //     $this->assign($assign);
    //     $this->display();
    // }

    /*权限列表*/
    public function rule_list(){
        $data=D('AuthRule')->getTreeData('tree','id','title');
        $assign=array(
            'data'=>$data
            );
        $this->assign($assign);
        $this->display();
    }

    /**
     * 添加权限
     */
    public function add(){
        $data=I('post.');
        unset($data['id']);
        $result=D('AuthRule')->addData($data);
        if($result){
            $this->success('添加成功',U('Admin/Rule/rule_list'));
        }else{
            $this->error('添加失败');
        }
    }

    /**
     * 修改权限
     */
    public function edit(){
        $data=I('post.');
        $map=array(
            'id'=>$data['id'] 
            );
        $result=D('AuthRule')->editData($map,$data);
        if ($result) {
            $this->success('修改成功',U('Admin/Rule/rule_list'));
        }else{
            $this->error('修改失败');
        }
    }

    /**
     * 删除权限
     */
    public function delete(){
        $id=I('get.id');
        $map=array(
            'id'=>$id
            );
        $result=D('AuthRule')->deleteData($map);
        if($result){
            $this->success('删除成功',U('Admin/Rule/rule_list'));
        }else{
            $this->error('请先删除子权限');
        }

    }

    /**
     * 角色列表
     */
    public function rule_group(){
        $data=D('AuthGroup')->select();
        $assign=array(
            'data'=>$data
            );
        $this->assign($assign);
        $this->display();
    }


     /**
     * 添加角色
     */
    public function add_group(){
        $data=I('post.');
        unset($data['id']);
        $result=D('AuthGroup')->addData($data);
        if ($result) {
            $this->success('添加成功',U('Admin/Rule/rule_group'));
        }else{
            $this->error('添加失败');
        }
    }

    /**
     * 修改角色
     */
    public function edit_group(){
        $data=I('post.');
        $map=array(
            'id'=>$data['id']
            );
        $result=D('AuthGroup')->editData($map,$data);
        if ($result) {
            $this->success('修改成功',U('Admin/Rule/rule_group'));
        }else{
            $this->error('修改失败');
        }
    }

    /**
     * 删除角色
     */
    public function delete_group(){
        $id=I('get.id');
        if ($id==1) {
            $this->error('该分组不能被删除');
        }
        $map=array(
            'id'=>$id
            );
        $result=D('AuthGroup')->where($map)->delete();
        if ($result) {
            $this->success('删除成功',U('Admin/Rule/rule_group'));
        }else{
            $this->error('删除失败');
        }
    }


    /**
     * 分配权限
     */
    public function rule_distribution(){
        if(IS_POST){
            $data=I('post.');
            $map=array(
                'id'=>$data['id']
                );
            $data['rules']=implode(',', $data['rule_ids']);
            $result=D('AuthGroup')->editData($map,$data);
            if ($result){
                $this->success('操作成功',U('Admin/Rule/rule_group'));
            }else{
                $this->error('操作失败');
            }
        }else{
            $id=I('get.id');
            // 获取用户组数据
            $group_data=M('Auth_group')->where(array('id'=>$id))->find();
            $group_data['rules']=explode(',', $group_data['rules']);
            // 获取规则数据
            $rule_data=D('AuthRule')->getTreeData('level','id','title');
            $assign=array(
                'group_data'=>$group_data,
                'rule_data'=>$rule_data
                );
            $this->assign($assign);
            $this->display();
        }
    }

}
