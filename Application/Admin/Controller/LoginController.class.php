<?php
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller
{
    public function index()
    {
        if($_SESSION['admin_data']){
            header('location:'.__APP__.'/Company/index.html');
        }else{
            $this->display();
        }
    }

    public function login()
    {
        $data['username']=I('username');
        $data['password']=md5(I('password'));
        $admin=M('admin')->where($data)->find();
        if($admin){
            $_SESSION['admin_data']=$admin;
            echo 'ok';
        }else{
            echo 'no';
        }
    }

    public function quit()
    {
        unset($_SESSION['admin_data']);
        header('location:'.__APP__.'/Login/index.html');
    }
}