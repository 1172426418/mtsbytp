<?php
namespace Admin\Controller;
use Think\Controller;
class BaseController extends Controller
{
    public function _initialize()
    {
        if($_SESSION['admin_data']){
            $this->assign('admin_data',$_SESSION['admin_data']);
            $base=M('config')->where(array('id'=>1))->find();//获取配置参数
            C($base);
        }else{
            //header('location:'.__APP__.'/Login/index.html');
            $this->redirect('Login/index');
        }
        
    }
    public function get_user($id){
    	$realname=M('user')->where(array('id'=>$id))->getField('realname');
    	return $realname;
    }
    
}