<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Upload;
class OneselfController extends BaseController
{
    public function update_data(){
        $admin=M('admin')->where('id='.$_SESSION['admin_data']['id'])->find();
        $this->assign('admin',$admin);
        $this->display();
    }

    public function update_pwd()
    {
        $admin=M('admin')->where('id='.$_SESSION['admin_data']['id'])->find();
        $this->assign('admin',$admin);
        $this->display();
    }

    public function update($id)
    {
        M('admin')->where('id='.$id)->save($_POST);
        $_SESSION['admin_data']=M('admin')->where('id='.$id)->find();
        header('location:'.__APP__.'/Oneself/update_data/id/'.$id.'.html');
    }

    public function up_pwd()
    {
        $is_ex=M('admin')->where('id='.$_POST['id'].' && password=\''.md5($_POST['old_password']).'\'')->find();
        if($is_ex){
            $pwd=array('password'=>md5($_POST['new_password']));
            $num=M('admin')->where('id='.$_POST['id'])->save($pwd);
            if($num>0){
                unset($_SESSION['admin_data']);
                echo 'ok';
            }else{
                echo 'no';
            }
        }else{
            echo 'no-old_password';
        }
    }

}