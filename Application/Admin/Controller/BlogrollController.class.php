<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Upload;
class BlogrollController extends BaseController {
    public function index()
    {
        $count=M('blogroll')->order("id desc")->count();
            $Page=new \Think\Page($count,8);
            $Page->setConfig('prev','上一页');
            $Page->setConfig('next','下一页');
            $Page->setConfig('theme',' <span>共<span> %TOTAL_ROW% </span>条记录</span><span style="padding-left:20px;">%FIRST%%UP_PAGE%%LINK_PAGE% %DOWN_PAGE%%END%
                                              </span> ');
            $show=$Page->show();
            $list =M('blogroll')->limit($Page->firstRow.','.$Page->listRows)->select();
            
            $this->assign('show',$show);
            $this->assign('urls',$list);
        $this->display();
    }

    //添加链接页面
    public function add_interlink()
    {
        $this->display();
    }

    //添加链接处理
    public function insert()
    {
        $upload=new Upload();  //实例化上传类
        $upload->maxSize=2000000; //控制上传文件的大小限制(0不做限制)
        $upload->exts=array('jpg','gif','png');  //允许上传文件的后缀
        $upload->autoSub=true;  //自动创建子目录
        $upload->rootPath="./"; //保存根路径
        $upload->savePath='public/upload/blogroll/'; //保存路径 必须以/结尾
        $up_img=$upload->uploadOne($_FILES['logo_img']); //开始单文件上传 成功返回一维关联数组，包含文件详细信息，失败返回false
        if($up_img){
            $_POST['path']=$up_img['savepath'].$up_img['savename'];
            $_POST['author']=$_SESSION['admin_data']['truename'];
            $_POST['date']=time();
            M('blogroll')->data($_POST)->add();
            header('location:'.__APP__.'/Blogroll/index.html');
        }else{
            header('location:'.__APP__.'/Blogroll/add_interlink.html');
        }
    }

    //编辑页面
    public function edit($id)
    {
        $blogroll=M('blogroll')->where('id='.$id)->find();
        $this->assign('blogroll',$blogroll);
        $this->display();
    }

    //产品编辑处理页面
    public function edit_form($id)
    {
        if($_FILES){
            $upload=new Upload();  //实例化上传类
            $upload->maxSize=2000000; //控制上传文件的大小限制(0不做限制)
            $upload->exts=array('jpg','gif','png');  //允许上传文件的后缀
            $upload->autoSub=true;  //自动创建子目录
            $upload->rootPath="./"; //保存根路径
            $upload->savePath='public/upload/blogroll/'; //保存路径 必须以/结尾
            $up_img=$upload->uploadOne($_FILES['logo_img']); //开始单文件上传 成功返回一维关联数组，包含文件详细信息，失败返回false
            if($up_img){
                $arr=M('blogroll')->where('id='.$id)->find();
                $path=$_SERVER['DOCUMENT_ROOT'].__ROOT__.'/'.$arr['path'];
                if(file_exists($path)){
                    unlink($path);
                }
                $_POST['path']=$up_img['savepath'].$up_img['savename'];
            }
        }
        $num=M('blogroll')->where('id='.$id)->save($_POST);
        header('location:'.__APP__.'/Blogroll/edit/id/'.$id.'.html');
    }

    //修改状态
    public function blog_update($id)
    {
        $blog=M('blogroll')->where('id='.$id)->find();
        if($blog['state']==0){  //如果状态为0，则代表要改为上线状态
            $arr=array(
                'state'=>1,
            );
            M('blogroll')->where('id='.$id)->save($arr);
            echo 'up';
        }else{
            $arr=array(
                'state'=>0,
            );
            M('blogroll')->where('id='.$id)->save($arr);
            echo 'dowm';
        }
    }

    //删除
    public function delete($id)
    {
        $arr=M('blogroll')->where('id='.$id)->find();
        $path=$_SERVER['DOCUMENT_ROOT'].__ROOT__.'/'.$arr['path'];
        if(file_exists($path)){
            unlink($path);
        }
        M('blogroll')->where('id='.$id)->delete();
        header('location:'.__APP__.'/Blogroll/index.html');
    }
}