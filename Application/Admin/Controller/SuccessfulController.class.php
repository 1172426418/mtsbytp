<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Upload;
class SuccessfulController extends BaseController {
    public function index()
    {
        if($_GET['suc']=='index'){
            $_GET['id']=$_SESSION['suc']['nowpage'];
            $_POST=$_SESSION['suc']['post'];
        }

        $length = 10;
        $nowpage = $_GET['id']?$_GET['id']:1;
        if($_GET['id']<=0){
            $nowpage = 1;
        }

        if($_POST){
           $where=$this->search($_POST,0);
            $num = M('production')->where(str_replace('n.','',str_replace('p.','',$where)))->count();       //总记录数
            $pages = ($num==0)?1:ceil($num/$length);  //总页数
            if($_GET['id']>$pages){
                $nowpage = $pages;
            }
            $offset = ($nowpage-1)*$length;                //偏移量
            $limit = $offset.','.$length;

           $sql='select p.id,p.path,p.title,n.menu,p.author,p.date,p.state from production as p inner join navigation as n on p.navi_id=n.id where '.$where.' limit '.$limit;
            $arr=M()->query($sql);
            $_SESSION['suc']['post']=$_POST;           //SESSION储存搜索条件
            $_SESSION['suc']['nowpage']=$nowpage;      //SESSION储存当前页
            $this->assign('post',$_POST);
        }else{
            $num = M('production')->where('pid=1 && is_delete=0 && is_moblie=0')->count();
            $pages = ($num==0)?1:ceil($num/$length);  //总页数
            if($_GET['id']>$pages){
                $nowpage = $pages;
            }
            $offset = ($nowpage-1)*$length;                  //偏移量
            $limit = $offset.','.$length;
            $sql='select p.id,p.path,p.title,n.menu,p.author,p.date,p.state from production as p inner join navigation as n on p.navi_id=n.id where n.pid=1 && p.is_delete=0 && p.is_moblie=0 limit '.$limit;
            $arr=M()->query($sql);
        }
        foreach($arr as $k=>$v){
            $arr[$k]['date']=date('Y年m月d日 H时i分',$v['date']);
        }
        $navigation=M('navigation')->where('pid=1')->select();
        $this->assign('navigation',$navigation);
        $this->assign('production',$arr);

        $this->assign('nowpage',$nowpage);  //当前页
        $this->assign('pages',$pages);      //总页数
        $this->assign('num',$num);          //总记录数
        $this->assign('limit',$limit);
        $this->display();
    }

    //分类标签管理
    public function menu()
    {
        $navigation=M('navigation')->where('pid=1')->select();
        foreach($navigation as $k=>$v){
            $navigation[$k]['num']=M('production')->where('navi_id='.$v['id'])->count();
            $navigation[$k]['state_num']=M('production')->where('navi_id='.$v['id'].' && state=1 && is_moblie=0')->count();
            $navigation[$k]['is_moblie']=M('production')->where('navi_id='.$v['id'].' && state=1 && is_moblie=1')->count();
        }
        $this->assign('navigation',$navigation);
        $this->display();
    }

    //添加案例页面
    public function insert()
    {
        $navigation=M('navigation')->where('pid=1')->select();
        $this->assign('navigation',$navigation);
        $this->display();
    }

    //回收站页面
    public function recycle()
    {
        if($_GET['suc']=='recycle'){
            $_GET['id']=$_SESSION['suc']['nowpage'];
            $_POST=$_SESSION['suc']['post'];
        }
        $length = 10;
        $nowpage = $_GET['id']?$_GET['id']:1;
        if($_GET['id']<=0){
            $nowpage = 1;
        }
        if($_POST){
            $where=$this->search($_POST,1,'rec');
            $num = M('production')->where(str_replace('n.','',str_replace('p.','',$where)))->count();       //总记录数
            $pages = ($num==0)?1:ceil($num/$length);  //总页数
            if($_GET['id']>$pages){
                $nowpage = $pages;
            }
            $offset = ($nowpage-1)*$length;                //偏移量
            $limit = $offset.','.$length;

            $sql='select p.id,p.path,p.title,n.menu,p.author,p.date,p.state,p.navi_id,p.is_moblie from production as p inner join navigation as n on p.navi_id=n.id where '.$where.' limit '.$limit;
            $arr=M()->query($sql);
            $_SESSION['suc']['post']=$_POST;           //SESSION储存搜索条件
            $_SESSION['suc']['nowpage']=$nowpage;      //SESSION储存当前页
            $this->assign('post',$_POST);
        }else{
            $num = M('production')->where('(navi_id=0 || pid=1) && is_delete=1')->count();
            $pages = ($num==0)?1:ceil($num/$length);  //总页数
            if($_GET['id']>$pages){
                $nowpage = $pages;
            }
            $offset = ($nowpage-1)*$length;                  //偏移量
            $limit = $offset.','.$length;
            $sql='select p.id,p.path,p.title,n.menu,p.author,p.date,p.state,p.navi_id,p.is_moblie from production as p inner join navigation as n on p.navi_id=n.id where (n.pid=1 || p.navi_id=0) && p.is_delete=1 limit '.$limit;
            $arr=M()->query($sql);
        }
        foreach($arr as $k=>$v){
            $arr[$k]['date']=date('Y年m月d日 H时i分',$v['date']);
        }
        $navigation=M('navigation')->where('pid=1')->select();
        $this->assign('navigation',$navigation);
        $this->assign('production',$arr);

        $this->assign('nowpage',$nowpage);  //当前页
        $this->assign('pages',$pages);      //总页数
        $this->assign('num',$num);          //总记录数
        $this->assign('limit',$limit);
        $this->display();
    }


    //添加案例处理页面
    public function insert_form()
    {
        if($_GET['is_moblie']==1){
            $_POST['is_moblie']=1;
            $url='moblie';
            $type='add_moblie';
        }else{
            $url='index';
            $type='insert';
        }
        $upload=new Upload();  //实例化上传类
        $upload->maxSize=5000000; //控制上传文件的大小限制(0不做限制)
        $upload->exts=array('jpg','gif','png');  //允许上传文件的后缀
        $upload->autoSub=true;  //自动创建子目录
        $upload->rootPath="./"; //保存根路径
        $upload->savePath='public/upload/successful/'; //保存路径 必须以/结尾
        $up_img=$upload->uploadOne($_FILES['logo']); //开始单文件上传 成功返回一维关联数组，包含文件详细信息，失败返回false
        if($up_img){
            $_POST['path']=$up_img['savepath'].$up_img['savename'];
            $_POST['author']=$_SESSION['admin_data']['truename'];
            $_POST['date']=time();
            $_POST['pid']=1;
            M('production')->data($_POST)->add();
            header('location:'.__APP__.'/Successful/'.$url.'.html');
        }else{
            header('location:'.__APP__.'/Successful/'.$type.'.html');
        }
    }

    //案例编辑页面
    public function edit($id)
    {
        $this->assign('url',$_GET['type']);
        $production=M('production')->where('id='.$id)->find();
        $navigation=M('navigation')->where('pid=1')->select();
        $this->assign('production',$production);
        $this->assign('navigation',$navigation);
        $this->display();
    }

    //案例编辑处理页面
    public function edit_form($id)
    {
        if($_FILES){
            $upload=new Upload();  //实例化上传类
            $upload->maxSize=5000000; //控制上传文件的大小限制(0不做限制)
            $upload->exts=array('jpg','gif','png');  //允许上传文件的后缀
            $upload->autoSub=true;  //自动创建子目录
            $upload->rootPath="./"; //保存根路径
            $upload->savePath='public/upload/successful/'; //保存路径 必须以/结尾
            $up_img=$upload->uploadOne($_FILES['logo']); //开始单文件上传 成功返回一维关联数组，包含文件详细信息，失败返回false
            if($up_img){
                $arr=M('production')->where('id='.$id)->find();
                $path=$_SERVER['DOCUMENT_ROOT'].__ROOT__.'/'.$arr['path'];
                if(file_exists($path)){
                    unlink($path);
                }
                $_POST['path']=$up_img['savepath'].$up_img['savename'];
            }
        }
        $_POST['pid']=1;
        $num=M('production')->where('id='.$id)->save($_POST);
        if($num>0){
            header('location:'.__APP__.'/Successful/'.$_GET['type'].'.html');
        }else{
            header('location:'.__APP__.'/Successful/edit/id/'.$id.'/type/'.$_GET['type'].'.html');
        }
    }

    //案例放入回收站
    public function get_recycle($id)
    {
        $url=$_GET['type']=='moblie'?$_GET['type']:'index';

        if(strpos($id,',')!==false){
            $id=substr($id,1);
        }
        $sql='update production set is_delete=1,state=0 where id in ('.$id.')';
        M()->execute($sql);
        header('location:'.__APP__.'/Successful/'.$url.'.html');
    }

    //删除回收站案例
    public function delete($id)
    {
        if(strpos($id,',')!==false){
            $id=substr($id,1);
        }

        $arr=M('production')->where('id in ('.$id.')')->select();
        foreach($arr as $k=>$v){
            $path=$_SERVER['DOCUMENT_ROOT'].__ROOT__.'/'.$v['path'];
            if(file_exists($path)){
                unlink($path);
            }
            M('production')->where('id='.$v['id'])->delete();
        }
        header('location:'.__APP__.'/Successful/recycle.html');
    }

    //回收站恢复案例
    public function restore($id)
    {
        if(strpos($id,',')!==false){
            $id=substr($id,1);
        }
        $restore=M('production')->where('id in ('.$id.')')->select();
        $arr=array('is_delete'=>0);
        foreach($restore as $k=>$v){
            if($v['navi_id']!=0){
                M('production')->where('id='.$v['id'])->save($arr);
            }
        }
        header('location:'.__APP__.'/Successful/recycle.html');
    }

    //ajax上线案例
    public function successful_up($id)
    {
            $arr=array('state'=>1);
            $num=M($_POST['type'])->where('id='.$id)->save($arr);
            echo $num;
    }

    //ajax下线案例
    public function successful_down($id)
    {
        $arr=array('state'=>0);
        $num=M($_POST['type'])->where('id='.$id)->save($arr);
        echo $num;
    }

    //ajax修改分类
    public function update_menu($id)
    {
        $len=strlen($_POST['menu']);
        if($len>15){
            echo 'gt-len';
        }else{
            $arr=array('menu'=>$_POST['menu']);
            $num=M('navigation')->where('id='.$id)->save($arr);
            echo $num;
        }
    }

    //搜索
    public function search($search,$num,$type)
    {
        $sql='';
        if($search['navi_id']!='no'){
            $sql.=' && p.navi_id='.$search['navi_id'];
        }
        if($search['state']!='no' && isset($search['state'])){
            $sql.=' && p.state='.$search['state'];
        }
        if($search['search']!=''){
            $sql.=' && (p.title like\'%'.$search['search'].'%\' || p.author like \'%'.$search['search'].'%\')';
        }
        if($type=='rec'){
            $sql=substr($sql.' && (n.pid=1 || p.navi_id=0) && p.is_delete='.$num,4);
        }elseif($type=='moblie'){
            $sql=substr($sql.' && is_moblie=1 && n.pid=1 && p.is_delete='.$num,4);
        }else{
            $sql=substr($sql.' && is_moblie=0 && n.pid=1 && p.is_delete='.$num,4);
        }
        return $sql;
    }

    //添加分类
    public function add_menu()
    {
        $_POST['pid']=1;
        $len=strlen($_POST['menu']);
        if($len>15){
            echo 'gt-len';
        }else{
            $num=M('navigation')->data($_POST)->add();
            echo $num;
        }
    }

    //删除分类
    public function delete_menu($id)
    {
        if(strpos($id,',')!==false){
            $id=substr($id,1);
        }
        $arr=array('state'=>0,'is_delete'=>1,'navi_id'=>0,'pid'=>0);
        M('production')->where('navi_id in ('.$id.')')->save($arr);
        M('navigation')->where('id='.$id)->delete();
        header('location:'.__APP__.'/Successful/menu.html');
    }

    //手机端管理
    public function moblie()
    {
        $length = 10;
        $nowpage = $_GET['id']?$_GET['id']:1;
        if($_GET['id']<=0){
            $nowpage = 1;
        }

        if($_POST){
            $where=$this->search($_POST,0,'moblie');
            $num = M('production')->where(str_replace('n.','',str_replace('p.','',$where)))->count();       //总记录数
            $pages = ($num==0)?1:ceil($num/$length);  //总页数
            if($_GET['id']>$pages){
                $nowpage = $pages;
            }
            $offset = ($nowpage-1)*$length;                //偏移量
            $limit = $offset.','.$length;

            $sql='select p.id,p.path,p.title,n.menu,p.author,p.date,p.state from production as p inner join navigation as n on p.navi_id=n.id where '.$where.' limit '.$limit;
            $arr=M()->query($sql);
            $_SESSION['suc']['post']=$_POST;           //SESSION储存搜索条件
            $_SESSION['suc']['nowpage']=$nowpage;      //SESSION储存当前页
            $this->assign('post',$_POST);
        }else{
            $num = M('production')->where('pid=1 && is_delete=0 && is_moblie=1')->count();
            $pages = ($num==0)?1:ceil($num/$length);  //总页数
            if($_GET['id']>$pages){
                $nowpage = $pages;
            }
            $offset = ($nowpage-1)*$length;                  //偏移量
            $limit = $offset.','.$length;
            $sql='select p.id,p.path,p.title,n.menu,p.author,p.date,p.state from production as p inner join navigation as n on p.navi_id=n.id where n.pid=1 && p.is_delete=0 && p.is_moblie=1 limit '.$limit;
            $arr=M()->query($sql);
        }


        foreach($arr as $k=>$v){
            $arr[$k]['date']=date('Y年m月d日 H时i分',$v['date']);
        }
        $navigation=M('navigation')->where('pid=1')->select();
        $this->assign('navigation',$navigation);
        $this->assign('production',$arr);

        $this->assign('nowpage',$nowpage);  //当前页
        $this->assign('pages',$pages);      //总页数
        $this->assign('num',$num);          //总记录数
        $this->assign('limit',$limit);
        $this->display();
    }

    public function add_moblie()
    {
        $navigation=M('navigation')->where('pid=1')->select();
        $this->assign('navigation',$navigation);
        $this->display();
    }
}












