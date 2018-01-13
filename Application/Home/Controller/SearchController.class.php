<?php
namespace Home\Controller;
use Think\Controller;
class SearchController extends Controller {

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
    public function index(){
         if(IS_GET){
            $keyword=I('keyword');
            if($_GET['type']){
                $type=I('type');
                // echo $type;die();
                if($type==1){
                    $count=M('event')->where(array('type'=>1,'state'=>1))->where("title like '%".$keyword."%' OR bereport like '%".$keyword."%'")->count();
                    $Page= new \Think\Page($count,5);
                    $Page->setConfig('first','首页');
                    $Page->setConfig('prev','上一页');
                    $Page->setConfig('next','下一页');
                    $Page->setConfig('theme',' <ul class="pager "> <li> %FIRST%</li> <li> %LINK_PAGE% </li><li> %DOWN_PAGE%</li> ');
                    $show=$Page->show();
                    $list=M('event')->where(array('type'=>1,'state'=>1))->where("title like '%".$keyword."%' OR bereport like '%".$keyword."%'")->limit($Page->firstRow.','.$Page->listRows)->getField("id,title,bereport,addtime,type");
                    $this->assign('page',$show);
                    $this->assign('list',$list);
                    $this->assign('keyword',$keyword);
                }else{
                    $count=M('event')->where(array('type'=>2,'state'=>1))->where("title like '%".$keyword."%' OR bereport like '%".$keyword."%'")->count();
                    $Page= new \Think\Page($count,5);
                    $Page->setConfig('first','首页');
                    $Page->setConfig('prev','上一页');
                    $Page->setConfig('next','下一页');
                    $Page->setConfig('theme',' <ul class="pager "> <li> %FIRST%</li> <li> %LINK_PAGE% </li><li> %DOWN_PAGE%</li> ');
                    $show=$Page->show();
                    $list=M('event')->where(array('type'=>2,'state'=>1))->where("title like '%".$keyword."%' OR bereport like '%".$keyword."%'")->limit($Page->firstRow.','.$Page->listRows)->getField("id,title,bereport,addtime,type");
                    $this->assign('page',$show);
                    $this->assign('list',$list);
                    $this->assign('keyword',$keyword);
                }
            }else{
                $count=M('event')->where(array('state'=>1))->where("title like '%".$keyword."%' OR bereport like '%".$keyword."%'")->count();
                $Page= new \Think\Page($count,5);
                $Page->setConfig('first','首页');
                $Page->setConfig('prev','上一页');
                $Page->setConfig('next','下一页');
                $Page->setConfig('theme',' <ul class="pager "> <li> %FIRST%</li> <li> %LINK_PAGE% </li><li> %DOWN_PAGE%</li> ');
                $show=$Page->show();
                $list=M('event')->where(array('state'=>1))->where("title like '%".$keyword."%' OR bereport like '%".$keyword."%'")->limit($Page->firstRow.','.$Page->listRows)->getField("id,title,bereport,addtime,type");
                $this->assign('page',$show);
                $this->assign('list',$list);
                $this->assign('keyword',$keyword);
                
            }

         }
        $this->display();
    }

    public function sendmail(){   
            $list=M('event')->where('id=20')->find(); 
             $cont='尊敬的用户您好，有一条关于举报您的案例《'.$list['title'].'》已发布到名声网，将会对您的信誉造成影响。点击<a href="http://1.msw110.com">查看详情</a>';
                $smail=SendMail('1172426418@qq.com','您好，'.$list['bereport'].',有关于您的一条负面消息已发布',$cont);
                echo $smail;
    }
    public function sendms(){
        $name='王二麻';
        $title='事件，已通过';
       
        $tel='13297973635';
        $smsparam="{\"name\":\"$name\",\"title\":\"$title\"}";
        $smstemplatecode="SMS_118580063";
        $resp=sendsms($smsparam,$smstemplatecode,$tel);
        echo $resp;
    }

}