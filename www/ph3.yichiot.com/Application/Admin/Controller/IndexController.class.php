<?php
namespace Admin\Controller;
use Common\Controller\AdminBaseController;
/**
 * 后台首页控制器
 */
class IndexController extends AdminBaseController{
	/**
	 * 首页
	 */
	public function index(){
		//p($_SESSION);

		// $version = Db::query('SELECT VERSION() AS ver');
        $config  = [
            'url'             => $_SERVER['HTTP_HOST'],
            'document_root'   => $_SERVER['DOCUMENT_ROOT'],
            'server_os'       => PHP_OS,
            'server_port'     => $_SERVER['SERVER_PORT'],
            'server_soft'     => $_SERVER['SERVER_SOFTWARE'],
            'php_version'     => PHP_VERSION,
            // 'mysql_version'   => $version[0]['ver'],
            'max_upload_size' => ini_get('upload_max_filesize')
        ];

        // return $this->fetch('index', ['config' => $config]);
		
		
		// 分配菜单数据
		// $nav_data=D('AdminNav')->getTreeData('level','order_number,id');
		// $assign=array(
		// 	'data'=>$nav_data
		// 	);
		// $this->assign($assign);

		$this->display('index', ['config' => $config]);
	}

	
	/**
	 * elements
	 */
	public function elements(){

		$this->display();
	}

	/**
     * 退出
     */
    public function logout(){
        session('user',null);
        session('data',null);
        $this->success('退出成功、前往登录页面',U('Home/Index/index'));
    }



}
