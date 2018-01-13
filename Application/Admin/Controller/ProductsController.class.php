<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Upload;
class ProductsController extends BaseController {
    public function index()
    {
        if($_GET['pro']=='index'){
            $_GET['id']=$_SESSION['pro']['nowpage'];
            $_POST=$_SESSION['pro']['post'];
        }

        $length = 10;
        $nowpage = $_GET['id']?$_GET['id']:1;
        if($_GET['id']<=0){
            $nowpage = 1;
        }

        if($_POST){
            $where=$this->search($_POST,0);
            $num = M('production')->where(str_replace('n.','',str_replace('p.','',$where)))->count();//总记录数
            $pages = ($num==0)?1:ceil($num/$length);  //总页数
            if($_GET['id']>$pages){
                $nowpage = $pages;
            }
            $offset = ($nowpage-1)*$length;                //偏移量
            $limit = $offset.','.$length;

            $sql='select p.id,p.path,p.title,n.menu,p.author,p.date,p.state from production as p inner join navigation as n on p.navi_id=n.id where '.$where.' limit '.$limit;
            $arr=M()->query($sql);
            $_SESSION['pro']['post']=$_POST;           //SESSION储存搜索条件
            $_SESSION['pro']['nowpage']=$nowpage;      //SESSION储存当前页
            $this->assign('post',$_POST);
        }else{
            $num = M('production')->where('pid=2 && is_delete=0')->count();
            $pages = ($num==0)?1:ceil($num/$length);  //总页数
            if($_GET['id']>$pages){
                $nowpage = $pages;
            }
            $offset = ($nowpage-1)*$length;                  //偏移量
            $limit = $offset.','.$length;
            $sql='select p.id,p.path,p.title,n.menu,p.author,p.date,p.state from production as p inner join navigation as n on p.navi_id=n.id where  n.pid=2 && p.is_delete=0 limit '.$limit;
            $arr=M()->query($sql);
        }
        foreach($arr as $k=>$v){
            $arr[$k]['date']=date('Y年m月d日 H时i分',$v['date']);
        }
        $navigation=M('navigation')->where('pid=2')->select();
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
        $navigation=M('navigation')->where('pid=2')->select();
        foreach($navigation as $k=>$v){
            $navigation[$k]['num']=M('production')->where('navi_id='.$v['id'])->count();
            $navigation[$k]['state_num']=M('production')->where('navi_id='.$v['id'].' && state=1')->count();
        }
        $this->assign('navigation',$navigation);
        $this->display();
    }

    //添加产品页面
    public function insert()
    {
        $navigation=M('navigation')->where('pid=2')->select();
        $this->assign('navigation',$navigation);
        $this->display();
    }

    //回收站页面
    public function recycle()
    {
        if($_GET['pro']=='recycle'){
            $_GET['id']=$_SESSION['pro']['nowpage'];
            $_POST=$_SESSION['pro']['post'];
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

            $sql='select p.id,p.path,p.title,n.menu,p.author,p.date,p.state,p.navi_id from production as p inner join navigation as n on p.navi_id=n.id where '.$where.' limit '.$limit;
            $arr=M()->query($sql);
            $_SESSION['pro']['post']=$_POST;           //SESSION储存搜索条件
            $_SESSION['pro']['nowpage']=$nowpage;      //SESSION储存当前页
            $this->assign('post',$_POST);
        }else{
            $num = M('production')->where('(navi_id=0 || pid=2) && is_delete=1')->count();
            $pages = ($num==0)?1:ceil($num/$length);  //总页数
            if($_GET['id']>$pages){
                $nowpage = $pages;
            }
            $offset = ($nowpage-1)*$length;                  //偏移量
            $limit = $offset.','.$length;
            $sql='select p.id,p.path,p.title,n.menu,p.author,p.date,p.state,p.navi_id from production as p inner join navigation as n on p.navi_id=n.id where (n.pid=2 || p.navi_id=0) && p.is_delete=1 limit '.$limit;
            $arr=M()->query($sql);
        }
        foreach($arr as $k=>$v){
            $arr[$k]['date']=date('Y年m月d日 H时i分',$v['date']);
        }
        $navigation=M('navigation')->where('pid=2')->select();
        $this->assign('navigation',$navigation);
        $this->assign('production',$arr);

        $this->assign('nowpage',$nowpage);  //当前页
        $this->assign('pages',$pages);      //总页数
        $this->assign('num',$num);          //总记录数
        $this->assign('limit',$limit);
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
        $upload->savePath='public/upload/products/'; //保存路径 必须以/结尾
        $up_img=$upload->uploadOne($_FILES['logo']); //开始单文件上传 成功返回一维关联数组，包含文件详细信息，失败返回false
        if($up_img){
            $_POST['path']=$up_img['savepath'].$up_img['savename'];
            $_POST['author']=$_SESSION['admin_data']['truename'];
            $_POST['date']=time();
            $_POST['pid']=2;
            M('production')->data($_POST)->add();
            header('location:'.__APP__.'/Products/index.html');
        }else{
            header('location:'.__APP__.'/Products/insert.html');
        }
    }

    //产品编辑页面
    public function edit($id)
    {
        $this->assign('url',$_GET['type']);
        $production=M('production')->where('id='.$id)->find();
        $navigation=M('navigation')->where('pid=2')->select();
        $this->assign('production',$production);
        $this->assign('navigation',$navigation);
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
            $upload->savePath='public/upload/product/'; //保存路径 必须以/结尾
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
        $_POST['pid']=2;
        $num=M('production')->where('id='.$id)->save($_POST);
        header('location:'.__APP__.'/Products/edit/id/'.$id.'/type/'.$_GET['type'].'.html');
    }

    //产品放入回收站
    public function get_recycle($id)
    {
        if(strpos($id,',')!==false){
            $id=substr($id,1);
        }
        $sql='update production set is_delete=1,state=0 where id in ('.$id.')';
        M()->execute($sql);
        header('location:'.__APP__.'/Products/index.html');
    }

    //删除回收站产品
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
        header('location:'.__APP__.'/Products/recycle.html');
    }

    //回收站恢复产品
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
        header('location:'.__APP__.'/Products/recycle.html');
    }

    //ajax上线产品
    public function Products_up($id)
    {
        $n=M($_POST['type'])->where('state=1 && pid=2')->count();
        if($n<11){
            $arr=array('state'=>1);
            $num=M($_POST['type'])->where('id='.$id)->save($arr);
            echo $num;
        }else{
            echo 'gt';
        }
    }

    //ajax下线产品
    public function Products_down($id)
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
            $sql=substr($sql.' && (n.pid=2 || p.navi_id=0) && p.is_delete='.$num,4);
        }else{
            $sql=substr($sql.' && n.pid=2 && p.is_delete='.$num,4);
        }

        return $sql;
    }

    //添加分类
    public function add_menu()
    {
        $_POST['pid']=2;
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
        M('navigation')->where('id in ('.$id.')')->delete();
        header('location:'.__APP__.'/Products/menu.html');
    }

    //改变推荐展示状态
    public function update_hot($id)
    {
        $hot=M('navigation')->where('id='.$id)->find();
        if($hot['is_hot']==0){
            $num=M('navigation')->where('pid=2 && is_hot=1')->count();
            if($num>=7){
                echo 'gt';
            }else{
                $arr=array('is_hot'=>1);
                $n=M('navigation')->where('id='.$id)->save($arr);
                if($n>0){
                    echo 'up_hot';
                }
            }
        }else{
            $arr=array('is_hot'=>0);
            $n=M('navigation')->where('id='.$id)->save($arr);
            if($n>0){
                echo 'down_hot';
            }
        }
    }
}












