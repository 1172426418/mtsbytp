<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Upload;
class InformationController extends BaseController {
    public function index()
    {
        $_GET['type']=isset($_GET['type'])?$_GET['type']:'公司咨询';
        $arr=M('information')->where('menu=\''.$_GET['type'].'\'')->select();
        foreach($arr as $k=>$v){
            $arr[$k]['date']=date('Y年m月d日 H时i分',$v['date']);
            if($v['recently_time']!=0){
                $arr[$k]['recently_time']=date('Y年m月d日 H时i分',$v['recently_time']);
                $arr[$k]['now_time']=$this->time_change(time()-$v['recently_time']);
            }
        }
        $this->assign('information',$arr);
        $this->assign('type',$_GET['type']);
        $this->display();
    }

    public function insert()
    {
        $this->assign('type',$_GET['type']);
        $this->display();
    }

    //编辑页面
    public function edit($id)
    {
        $information=M('information')->where('id='.$id)->find();
        $this->assign('information',$information);
        $this->assign('type',$_GET['type']);
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
            $upload->savePath='public/upload/information/'; //保存路径 必须以/结尾
            $up_img=$upload->uploadOne($_FILES['logo']); //开始单文件上传 成功返回一维关联数组，包含文件详细信息，失败返回false
            if($up_img){
                $arr=M('information')->where('id='.$id)->find();
                $path=$_SERVER['DOCUMENT_ROOT'].__ROOT__.'/'.$arr['path'];
                if(file_exists($path)){
                    unlink($path);
                }
                $_POST['path']=$up_img['savepath'].$up_img['savename'];
            }
        }
        $num=M('information')->where('id='.$id)->save($_POST);
        header('location:'.__APP__.'/information/edit/id/'.$id.'/type/'.$_GET['type'].'.html');
    }

    //添加处理
    public function insert_form()
    {
        $upload=new Upload();  //实例化上传类
        $upload->maxSize=2000000; //控制上传文件的大小限制(0不做限制)
        $upload->exts=array('jpg','gif','png');  //允许上传文件的后缀
        $upload->autoSub=true;  //自动创建子目录
        $upload->rootPath="./"; //保存根路径
        $upload->savePath='public/upload/information/'; //保存路径 必须以/结尾
        $up_img=$upload->uploadOne($_FILES['logo']); //开始单文件上传 成功返回一维关联数组，包含文件详细信息，失败返回false
        if($up_img){
            $_POST['path']=$up_img['savepath'].$up_img['savename'];
            $_POST['author']=$_SESSION['admin_data']['truename'];
            $_POST['date']=time();
            M('information')->data($_POST)->add();
            header('location:'.__APP__.'/Information/index/type/'.$_GET['type'].'.html');
        }else{
            header('location:'.__APP__.'/Information/insert/type/'.$_GET['type'].'.html');
        }
    }

    //删除
    public function delete($id)
    {
        $arr=M('information')->where('id='.$id)->find();
        $path=$_SERVER['DOCUMENT_ROOT'].__ROOT__.'/'.$arr['path'];
        if(file_exists($path)){
            unlink($path);
        }
        M('information')->where('id='.$id)->delete();
        header('location:'.__APP__.'/Information/index.html');
    }

    //修改状态
    public function infor_update($id)
    {
        $infor=M('information')->where('id='.$id)->find();
        $num=M('information')->where('menu=\''.$_POST['type'].'\' && state=1')->count();
        if($infor['state']==0){  //如果状态为0，则代表要改为上线状态
            if($num>=4){  //如果已展示的达到4个，无法更改展示
                echo 'gt';
            }else{
                $arr=array(
                    'state'=>1,
                    'recently_time'=>time()
                );
                M('information')->where('id='.$id)->save($arr);
                echo date('Y年m月d日 H时i分',time());
            }
        }else{
            $arr=array(
                'state'=>0,
                'recently_time'=>0
            );
            M('information')->where('id='.$id)->save($arr);
            echo 'dowm';
        }
    }

    //ajax判断logo图是否已经上传10张
    public function is_ten()
    {
        $num=M('information')->where('menu=\''.$_POST['type'].'\'')->count();
        if($num>=10){
            echo 'gt_ten';
        }else{
            echo 'lt_ten';
        }
    }

    //将时间戳转换为对应的小时，天，月，年时间
    public function time_change($time)
    {
        if(($time/(3600*24*365))>=1){
            $date=floor($time/(3600*24*365)).'年';
        }elseif(($time/(3600*24*30))>=1){
            $date=floor($time/(3600*24*30)).'月';
        }elseif(($time/(3600*24))>=1){
            $date=floor($time/(3600*24)).'天';
        }elseif($time/3600>=1){
            $date=floor($time/(3600)).'小时';
        }else if($time/60>=1){
            $date=floor($time/(60)).'分钟';
        }else{
            $date='1分钟';
        }
        return $date;
    }
}