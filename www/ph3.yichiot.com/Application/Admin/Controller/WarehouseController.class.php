<?php
namespace Admin\Controller;
use Common\Controller\AdminBaseController;
/**
 * 用户列表
 */
class WarehouseController extends AdminBaseController{

	public function add(){
        if($_POST){
            $post = $_POST; //pp($post);
            $name = $post['name'];
            $floor = intval($post['floor']);
            $data['name'] = $name;
            $data['total_floor'] = $floor;
            $res = D('Warehouse')->add($data);//pp($res);
            if($res){
                //$info['warehouse_id'] = intval($res);
                //$return = D('Floor')->add($info);
              
                     $this->success('添加成功');
               
            }else{
                $this->error('添加失败');
            }
      }

    }


}
