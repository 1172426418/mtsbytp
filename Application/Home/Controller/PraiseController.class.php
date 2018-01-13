<?php
namespace Home\Controller;
use Think\Controller;
class PraiseController extends Controller {
    
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
        $count=M('event')->where(array('type'=>2,'state'=>1))->order("addtime desc")->count();
        $Page=new \Think\Page($count,10);
        $Page->setConfig('first','首页');
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $Page->setConfig('theme',' <ul class="pager "> <li> %FIRST%</li> <li> %LINK_PAGE% </li><li> %DOWN_PAGE%</li> ');
        $show=$Page->show();
        $list=M('event')->where(array('type'=>2,'state'=>1))->limit($Page->firstRow.','.$Page->listRows)->order("addtime desc")->select();

        $this->assign('list',$list);
        $this->assign('page',$show);
        $this->display();
    }


        /**
     * 发布表扬
     */
    public function ReleasePraise(){

        if(IS_AJAX){
            $data['report_id']=$_SESSION['user_id'];;
            $data['report']=$_SESSION['user']['realname'];
            $data['type']=2;
            $data['title']=I('title');
            $data['bereport']=I('bereport');
            $data['betel']=I('betel');
            $data['content']=I('content');
            $data['beemail']=I('email');
            $data['becard']=I('becard');
            $data['addtime']=time();
            $data['save_money']=C('praise_money');
            if($data['title']=='' || $data['bereport']=='' || $data['betel']=='' || $data['content']==''){
                $this->ajaxReturn(array('code'=>0,'msg'=>'请将数据补充完整！'));
                exit();
            }
            $pattern = "/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i";
            if($data['beemail'] !=''){
                if (!preg_match( $pattern, $data['beemail'])){
                $this->ajaxReturn(array('code'=>0,'msg'=>'请输入正确的邮箱格式'));
                exit();
                }
            }
            if($data['becard']!=''){
                if(!validation_filter_id_card($data['becard'])){
                    $this->ajaxReturn(array('code'=>0,'msg'=>'请输入正确的身份证格式'));
                    exit();   
                }
            }
             if(!preg_match("/^1[34578]\d{9}$/", $data['betel'])){
                $this->ajaxReturn(array('code'=>0,'msg'=>'请输入正确的手机号'));
                exit();
            }
            $money=M('user')->where(array('id'=>$data['report_id']))->getField('money');
            if($money < C('praise_money')){
                $this->ajaxReturn(array('code'=>3,'msg'=>'余额不足！'));
                exit();
            }
            
            $result=M('event')->data($data)->add();
            if($result){
                M('user')->where(array('id'=>$data['report_id']))->save(array('money'=>$money-C('praise_money')));
                $this->ajaxReturn(array('code'=>1,'msg'=>'操作成功，请等待审核！'));
            }else{
                $this->ajaxReturn(array('code'=>0,'msg'=>'请稍后再试'));
            }
        }

        $this->display();
    }

    public function Release(){
        if(!isset($_SESSION['user_id'])){
            redirect(__ROOT__.'/index.php/login/index.html');
        }
        $this->display();
    }
    /**
     * 表扬案例详情
     * @return [type] [description]
     */
    public function details(){
        $id=I('id');
        $result=M('event')->where(array('id'=>$id,'state'=>1))->find();
        $this->assign('result',$result);
        $count=M('comment')->where(array('event_id'=>$id))->order("addtime desc")->count();
        $Page=new \Think\Page($count,5);
        $Page->setConfig('first','首页');
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $Page->setConfig('theme',' <ul class="pager "> <li> %FIRST%</li> <li> %LINK_PAGE% </li><li> %DOWN_PAGE%</li> ');
        $show=$Page->show();
        $list=M('comment')->where(array('event_id'=>$id))->limit($Page->firstRow.','.$Page->listRows)->order("addtime desc")->select();

        $this->assign('list',$list);
        $this->assign('page',$show);

        $this->display();
    }
    /**
     * 评论
     */
    public function Comment(){
        if(IS_AJAX){
            $id=I('event_id');
            $result=M('event')->where(array('id'=>$id,'state'=>1))->find();

            if($result){
                $data['content']=I('content');
                 if($data['content']==''){
                    $this->ajaxReturn(array('code'=>0,'msg'=>'请输入内容！'));
                    exit();
                }
                $data['addtime']=time();
                $data['event_id']=$id;
                $data['report_id']=$result['report_id'];
                $data['user_id']=$_SESSION['user_id'];
                $data['type']=2;
                $m=M('comment')->data($data)->add();
                if($m){
                    $this->ajaxReturn(array('code'=>1,'msg'=>'留言成功'));
                }else{
                    $this->ajaxReturn(array('code'=>0,'msg'=>'请稍后再试'));
                }
            }else{
                    $this->ajaxReturn(array('code'=>0,'msg'=>'请稍后再试'));
            }
        }
    }
}












