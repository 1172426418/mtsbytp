<?php
namespace Home\Controller;
use Think\Controller;
class CaseController extends Controller {
     public function _initialize(){
     
            $qrcode=M("image")->where("id > 8")->getField("id,image,address");//获取二维码
            $this->assign('qrcode',$qrcode);
            $base=M('config')->where(array('id'=>1))->find();//获取配置参数
            C($base);
            if(isset($_SESSION['user_id'])){
            $id=$_SESSION['user_id'];
            $result=M('user')->where(array('id'=>$id))->find();
            $this->assign('result',$result);
            $realname=$_SESSION['user']['realname'];
            $this->assign('realname',$realname);
          
        }
          $link=M('blogroll')->where(array('state'=>1))->select();
          $this->assign('link',$link);
  
    }
    public function index()
    {
        $count=M('case')->order("addtime desc")->count();
        $Page=new \Think\Page($count,5);
        $Page->setConfig('first','首页');
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $Page->setConfig('theme',' <ul class="pager "> <li> %FIRST%</li> <li> %LINK_PAGE% </li><li> %DOWN_PAGE%</li> ');
        $show=$Page->show();
        $list=M('case')->limit($Page->firstRow.','.$Page->listRows)->order("addtime desc")->select();

        $this->assign('list',$list);
        $this->assign('page',$show);
        $this->display();
    }


    public function details(){
        $id=I('id');
        $list=M('case')->where(array('id'=>$id))->find();
        $this->assign('list',$list);

        $this->display();
    }

}












