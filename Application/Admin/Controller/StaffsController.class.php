<?php
namespace Admin\Controller;
use Think\Controller;
class StaffsController extends BaseController
{
    public function index()
    {
        $length = 10;
        $nowpage = $_GET['id']?$_GET['id']:1;
        if($_GET['id']<=0){
            $nowpage = 1;
        }
        if($_POST){
            if($_POST['search']!=''){
                $where='(truename like \'%'.$_POST['search'].'%\' || phone like \'%'.$_POST['search'].'%\') && jurisdiction<3';
            }else{
                $where='jurisdiction<3';
            }
           $num = M('admin')->where($where)->count();
            $pages = ($num==0)?1:ceil($num/$length);  //总页数
            if($_GET['id']>$pages){
                $nowpage = $pages;
            }
            $offset = ($nowpage-1)*$length;                //偏移量
            $limit = $offset.','.$length;
            $admins = M('admin')->where($where)->limit($limit)->select();
            $this->assign('post',$_POST);
        }else{
            $num=M('admin')->where('jurisdiction<3')->count();
            $pages = ($num==0)?1:ceil($num/$length);  //总页数
            if($_GET['id']>$pages){
                $nowpage = $pages;
            }
            $offset = ($nowpage-1)*$length;                  //偏移量
            $limit = $offset.','.$length;
            $admins = M('admin')->where('jurisdiction<3')->limit($limit)->select();
        }
        foreach ($admins as $k => $v) {
            $admins[$k]['date'] = date('Y年m月d日 H时i分', $v['date']);
        }
        $this->assign('admins', $admins);
        $this->assign('nowpage',$nowpage);  //当前页
        $this->assign('pages',$pages);      //总页数
        $this->assign('num',$num);          //总记录数
        $this->assign('limit',$limit);
        $this->display();
    }

    //添加管理员
    public function admin_add()
    {
        $this->display();
    }

    //添加管理员处理
    public function insert()
    {
        $_POST['date'] = time();
        $_POST['password'] = md5($_POST['password']);
        M('admin')->data($_POST)->add();
        header('location:' . __APP__ . '/Staffs/index.html');
    }

    //管理员资料编辑
    public function edit($id)
    {
        $admin = M('admin')->where('id=' . $id)->find();
        $this->assign('admin', $admin);
        $this->display();
    }

    //员工资料编辑处理
    public function update($id)
    {
        if($_POST['password']){
            $_POST['password']=md5($_POST['password']);
        }
        M('admin')->where('id='.$id)->save($_POST);
        $_SESSION['admin_data']=M('admin')->where('id='.$id)->find();
        header('location:'.__APP__.'/Staffs/edit/id/'.$id.'.html');
    }

    //删除管理员
    public function delete($id)
    {
        M('admin')->where('id='.$id)->delete();
        header('location:'.__APP__.'/Staffs/index.html');
    }

    //ajax获取用户权限
    public function admin_open($id)
    {
        $arr=array('jurisdiction'=>1);
       $num= M('admin')->where('id='.$id)->save($arr);
       echo $num;
    }

    //ajax停用用户权限
    public function admin_close($id)
    {
        $arr=array('jurisdiction'=>0);
        $num= M('admin')->where('id='.$id)->save($arr);
        echo $num;
    }

    //添加员工ajax验证唯一字段
    public function sole()
    {
        if(M('admin')->where('username=\''.$_POST['username'].'\'')->find()){
            echo 'exist-username';
        }elseif(M('admin')->where('phone=\''.$_POST['phone'].'\'')->find()){
            echo 'exist-phone';
        }elseif(M('admin')->where('email=\''.$_POST['email'].'\'')->find()){
            echo 'exist-email';
        }else{
            echo 'ok';
        }
    }

    //编辑员工资料ajax判断唯一字段
    public function edit_sole()
    {
        $admin=M('admin')->where('id='.$_POST['id'])->find();
        if(M('admin')->where('phone='.$_POST['phone'].' && phone!='.$admin['phone'])->find()){
            echo 'exist-phone';
        }elseif(M('admin')->where('email=\''.$_POST['email'].'\' && email!=\''.$admin['email'].'\'')->find()){
            echo 'exist-email';
        }else{
            echo 'ok';
        }
    }
}