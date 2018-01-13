<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Upload;
class DynamicController extends BaseController {
    public function index()//-------------
    {
        if($_GET['dyn']=='index'){
            $_GET['id']=$_SESSION['dyn']['nowpage'];
            $_POST=$_SESSION['dyn']['post'];
        }

        $length = 10;
        $nowpage = $_GET['id']?$_GET['id']:1;
        if($_GET['id']<=0){
            $nowpage = 1;
        }

        if($_POST){
            $where=$this->search($_POST,0);
            $num = M('dynamic')->where($where)->count();       //总记录数
            $pages = ($num==0)?1:ceil($num/$length);  //总页数
            if($_GET['id']>$pages){
                $nowpage = $pages;
            }
            $offset = ($nowpage-1)*$length;                //偏移量
            $limit = $offset.','.$length;

            $arr=M('dynamic')->where($where)->limit($limit)->select();
            $_SESSION['dyn']['post']=$_POST;           //SESSION储存搜索条件
            $_SESSION['dyn']['nowpage']=$nowpage;      //SESSION储存当前页
            $this->assign('post',$_POST);
        }else{
            $num = M('dynamic')->where('is_delete=0')->count();
            $pages = ($num==0)?1:ceil($num/$length);  //总页数
            if($_GET['id']>$pages){
                $nowpage = $pages;
            }
            $offset = ($nowpage-1)*$length;                  //偏移量
            $limit = $offset.','.$length;
            $arr=M('dynamic')->where('is_delete=0')->limit($limit)->select();
        }
        foreach($arr as $k=>$v){
            $arr[$k]['date']=date('Y年m月d日 H时i分',$v['date']);
        }
        $this->assign('dynamic',$arr);

        $this->assign('nowpage',$nowpage);  //当前页
        $this->assign('pages',$pages);      //总页数
        $this->assign('num',$num);          //总记录数
        $this->assign('limit',$limit);
        $this->display();
    }

    //添加产品页面
    public function insert()
    {
        $this->display();
    }

    //添加产品处理页面
    public function insert_form()
    {
        $upload=new Upload();  //实例化上传类
        $upload->maxSize=2000000; //控制上传文件的大小限制(0不做限制)
        $upload->exts=array('jpg','gif','png');  //允许上传文件的后缀
        $upload->autoSub=true;  //自动创建子目录
        $upload->rootPath="./"; //保存根路径
        $upload->savePath='public/upload/dynamic/'; //保存路径 必须以/结尾
        $up_img=$upload->uploadOne($_FILES['logo']); //开始单文件上传 成功返回一维关联数组，包含文件详细信息，失败返回false
        if($up_img){
            $_POST['path']=$up_img['savepath'].$up_img['savename'];
            $_POST['author']=$_SESSION['admin_data']['truename'];
            $_POST['date']=time();
            M('dynamic')->data($_POST)->add();
            header('location:'.__APP__.'/Dynamic/index.html');
        }else{
            header('location:'.__APP__.'/Dynamic/insert.html');
        }
    }

    //回收站页面-------------
    public function recycle()
    {
        if($_GET['dyn']=='recycle'){
            $_GET['id']=$_SESSION['dyn']['nowpage'];
            $_POST=$_SESSION['dyn']['post'];
        }
        $length = 10;
        $nowpage = $_GET['id']?$_GET['id']:1;
        if($_GET['id']<=0){
            $nowpage = 1;
        }
        if($_POST){
            $where=$this->search($_POST,1);
            $num = M('dynamic')->where($where)->count();       //总记录数
            $pages = ($num==0)?1:ceil($num/$length);  //总页数
            if($_GET['id']>$pages){
                $nowpage = $pages;
            }
            $offset = ($nowpage-1)*$length;                //偏移量
            $limit = $offset.','.$length;

            $arr=M('dynamic')->where($where)->limit($limit)->select();
            $_SESSION['dyn']['post']=$_POST;           //SESSION储存搜索条件
            $_SESSION['dyn']['nowpage']=$nowpage;      //SESSION储存当前页
            $this->assign('post',$_POST);
        }else{
            $num = M('dynamic')->where('is_delete=1')->count();
            $pages = ($num==0)?1:ceil($num/$length);  //总页数
            if($_GET['id']>$pages){
                $nowpage = $pages;
            }
            $offset = ($nowpage-1)*$length;                  //偏移量
            $limit = $offset.','.$length;
            $arr=M('dynamic')->where('is_delete=1')->limit($limit)->select();
        }
        foreach($arr as $k=>$v){
            $arr[$k]['date']=date('Y年m月d日 H时i分',$v['date']);
        }
        $this->assign('dynamic',$arr);

        $this->assign('nowpage',$nowpage);  //当前页
        $this->assign('pages',$pages);      //总页数
        $this->assign('num',$num);          //总记录数
        $this->assign('limit',$limit);
        $this->display();
    }

    //产品编辑页面
    public function edit($id)
    {
        $this->assign('url',$_GET['type']);
        $dynamic=M('Dynamic')->where('id='.$id)->find();
        $this->assign('dynamic',$dynamic);
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
            $upload->savePath='public/upload/dynamic/'; //保存路径 必须以/结尾
            $up_img=$upload->uploadOne($_FILES['logo']); //开始单文件上传 成功返回一维关联数组，包含文件详细信息，失败返回false
            if($up_img){
                $arr=M('dynamic')->where('id='.$id)->find();
                $path=$_SERVER['DOCUMENT_ROOT'].__ROOT__.'/'.$arr['path'];
                if(file_exists($path)){
                    unlink($path);
                }
                $_POST['path']=$up_img['savepath'].$up_img['savename'];
            }
        }
        $num=M('dynamic')->where('id='.$id)->save($_POST);
        header('location:'.__APP__.'/Dynamic/edit/id/'.$id.'/type/'.$_GET['type'].'.html');
    }

    //产品放入回收站
    public function get_recycle($id)
    {
        if(strpos($id,',')!==false){
            $id=substr($id,1);
        }
        $sql='update dynamic set is_delete=1,state=0 where id in ('.$id.')';
        M()->execute($sql);
        header('location:'.__APP__.'/dynamic/index.html');
    }

    //删除回收站产品
    public function delete($id)
    {
        if(strpos($id,',')!==false){
            $id=substr($id,1);
        }

        $arr=M('dynamic')->where('id in ('.$id.')')->select();
        foreach($arr as $k=>$v){
            $path=$_SERVER['DOCUMENT_ROOT'].__ROOT__.'/'.$v['path'];
            if(file_exists($path)){
                unlink($path);
            }
            M('dynamic')->where('id='.$v['id'])->delete();
        }
        header('location:'.__APP__.'/Dynamic/recycle.html');
    }

    //回收站恢复产品
    public function restore($id)
    {
        if(strpos($id,',')!==false){
            $id=substr($id,1);
        }
        $arr=array('is_delete'=>0);
        M('dynamic')->where('id in ('.$id.')')->save($arr);
        header('location:'.__APP__.'/Dynamic/recycle.html');
    }

    //ajax上线产品
    public function Dynamic_up($id)
    {
        $arr=array('state'=>1);
        $num=M('dynamic')->where('id='.$id)->save($arr);
        echo $num;
    }

    //ajax下线产品
    public function Dynamic_down($id)
    {
        $arr=array('state'=>0);
        $num=M('dynamic')->where('id='.$id)->save($arr);
        echo $num;
    }

    //搜索
    public function search($search,$num)
    {
        $sql='';
        if($search['state']!='no' && isset($search['state'])){
            $sql.=' && state='.$search['state'];
        }
        if($search['search']!=''){
            $sql.=' && (title like\'%'.$search['search'].'%\' || author like \'%'.$search['search'].'%\')';
        }
        $sql=substr($sql.' && is_delete='.$num,4);
        return $sql;
    }

}












