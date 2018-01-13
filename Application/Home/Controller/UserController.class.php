<?php
namespace Home\Controller;
use Think\Controller;
class UserController extends BaseController {



    public function __construct(){
        //移动设备浏览，则切换模板
        parent::__construct();
        if (ismobile()) {
            //设置默认默认主题为 Mobile
            C('DEFAULT_THEME','Mobile');
        }
        
    }
    /**
     * @return 
     * 进入个人中心
     */

    public function index(){
        // if (ismobile()) {
        //     //设置默认默认主题为 Mobile
        //     C('DEFAULT_THEME','Mobile');
        // }
        $this->display();
    }

    /**
     * @return [code]
     * 修改用户个人资料
     */
    public function EditProfile(){
        if(IS_AJAX){
            $id=$_SESSION['user_id'];
            $is_authenticate=M('user')->where(array('id'=>$id))->getField('is_authenticate');
            if($is_authenticate!=1){
                 $data['realname']=I('realname');
            }   
            // $this->ajaxReturn($_SESSION['user']);
                $data['qq']=I('qq');
                if($data['qq']!=''){
                if(!is_numeric($data['qq'])){
                    $this->ajaxReturn(array('code'=>0,'msg'=>'格式不正确'));
                    exit();
                }
            }
                // $data['tel']=I('tel');
                // if(M('user')->where(array('tel'=>$data['tel']))->find()){
                //      $this->ajaxReturn(array('code'=>0,'msg'=>'该手机号已绑定'));
                //      exit();
                // }
                $result=M('user')->where(array('id'=>$id))->save($data);
                if($result){
                    $this->ajaxReturn(array('code'=>1,'msg'=>'修改成功'));
                }else{
                    $this->ajaxReturn(array('code'=>0,'msg'=>'修改成功'));
                }
                exit();
        }
        $this->display();
    }
    /**
     * 我发布的表扬
     */
    public function MyRelease(){
        $id=$_SESSION['user_id'];
        $count=M('event')->where(array('report_id'=>$id,'type'=>2))->order("id desc")->count();
        $Page=new \Think\Page($count,10);
        $Page->setConfig('first','首页');
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $Page->setConfig('theme',' <ul class="pager "> <li> %FIRST%</li> <li> %LINK_PAGE% </li><li> %DOWN_PAGE%</li> ');
        $show=$Page->show();
        $list=M('event')->where(array('report_id'=>$id,'type'=>2))->limit($Page->firstRow.','.$Page->listRows)->order("id desc")->getField("id,title,addtime,state");
        $this->assign('page',$show);
        $this->assign('list',$list);
        $this->display();
    }

    /**
     * 表扬详情页
     */
        public function MyReleaseDetails(){
        $id=I('id');
        $user_id=$_SESSION['user_id'];
        $result=M('event')->where(array('id'=>$id,'report_id'=>$user_id))->find();
        $this->assign('result',$result);
        $count=M('comment')->where(array('event_id'=>$id))->count();
        $Page=new \Think\Page($count,5);
        $Page->setConfig('first','首页');
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $Page->setConfig('theme',' <ul class="pager "> <li> %FIRST%</li> <li> %LINK_PAGE% </li><li> %DOWN_PAGE%</li> ');
        $show=$Page->show();
        $list=M('comment')->where(array('event_id'=>$id))->limit($Page->firstRow.','.$Page->listRows)->select();

        $this->assign('list',$list);
        $this->assign('page',$show);

        $this->display();
    }

    /**
     * 我的举报
     */
    public function MyReport(){
        $id=$_SESSION['user_id'];
     
        $count=M('event')->where(array('report_id'=>$id,'type'=>1))->order("id desc")->count();
        $Page=new \Think\Page($count,10);
        $Page->setConfig('first','首页');
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $Page->setConfig('theme',' <ul class="pager "> <li> %FIRST%</li> <li> %LINK_PAGE% </li><li> %DOWN_PAGE%</li> ');
        $show=$Page->show();
        $list=M('event')->where(array('report_id'=>$id,'type'=>1))->limit($Page->firstRow.','.$Page->listRows)->order("id desc")->getField("id,title,addtime,state");


        $this->assign('page',$show);
        $this->assign('list',$list);
        $this->display();
    }

    /**
     * 举报详情页
     */
    public function MyReportDetails(){
        $id=I('id');
        $user_id=$_SESSION['user_id'];
        $result=M('event')->where(array('id'=>$id,'report_id'=>$user_id))->find();
        $this->assign('result',$result);
        $count=M('comment')->where(array('event_id'=>$id))->count();
        $Page=new \Think\Page($count,5);
        $show=$Page->show();
        $list=M('comment')->where(array('event_id'=>$id))->limit($Page->firstRow.','.$Page->listRows)->select();

        $this->assign('list',$list);
        $this->assign('page',$show);

        $this->display();
    }
    /**
     * 我的被举报
     */
    public function MyBereport(){
        $id=$_SESSION['user_id'];;
        $tel=$_SESSION['user']['tel'];
        $count=M('event')->where(array('betel'=>$tel,'type'=>1))->where("state != 2")->order("id desc")->count();
        $Page=new \Think\Page($count,10);
        $Page->setConfig('first','首页');
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $Page->setConfig('theme',' <ul class="pager "> <li> %FIRST%</li> <li> %LINK_PAGE% </li><li> %DOWN_PAGE%</li> ');
        $show=$Page->show();
        $list=M('event')->where(array('betel'=>$tel,'type'=>1))->where("state != 2")->limit($Page->firstRow.','.$Page->listRows)->order("id desc")->getField("id,title,addtime,state");
        $this->assign('page',$show);
        $this->assign('list',$list);
        $this->display();
    }
    /**
     * 我的被举报详情页
     */
    public function MyBereportDetails(){
        $id=I('id');
        $user_id=$_SESSION['user_id'];
        $tel=$_SESSION['user']['tel'];
        $result=M('event')->where(array('id'=>$id,'betel'=>$tel))->find();
        $this->assign('result',$result);
        // $count=M('comment')->where(array('event_id'=>$id))->count();
        // $Page=new \Think\Page($count,5);
        // $show=$Page->show();
        // $list=M('comment')->where(array('event_id'=>$id))->limit($Page->firstRow.','.$Page->listRows)->select();

        // $this->assign('list',$list);
        // $this->assign('page',$show);

        $this->display();
    }
    /**
     * 我的保全令
     */
    public function MySave(){
        $id=$_SESSION['user_id'];
        $tel=$_SESSION['user']['tel'];
        $count=M('event')->where(array('betel'=>$tel,'type'=>1,'save_state'=>1))->order("id desc")->count();
        $Page=new \Think\Page($count,10);
        $Page->setConfig('first','首页');
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $Page->setConfig('theme',' <ul class="pager "> <li> %FIRST%</li> <li> %LINK_PAGE% </li><li> %DOWN_PAGE%</li> ');
        $show=$Page->show();
        $list=M('event')->where(array('betel'=>$tel,'type'=>1,'save_state'=>1))->limit($Page->firstRow.','.$Page->listRows)->order("id desc")->getField("id,title,addtime,state");
        $this->assign('page',$show);
        $this->assign('list',$list);
        $this->display();
    }
    /**
     * 我收到的保全令
     */
    public function MyBesave(){
        $id=$_SESSION['user_id'];
        $count=M('event')->where(array('report_id'=>$id,'type'=>1,'save_state'=>1))->order("id desc")->count();
        $Page=new \Think\Page($count,10);
        $Page->setConfig('first','首页');
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $Page->setConfig('theme',' <ul class="pager "> <li> %FIRST%</li> <li> %LINK_PAGE% </li><li> %DOWN_PAGE%</li> ');
        $show=$Page->show();
        $list=M('event')->where(array('report_id'=>$id,'type'=>1,'save_state'=>1))->limit($Page->firstRow.','.$Page->listRows)->order("id desc")->getField("id,title,addtime,state");
        $this->assign('page',$show);
        $this->assign('list',$list);
        $this->display();
    }
    /**
     * 我收到的保全令详情页
     */
    public function MyBesaveDetails(){
        $id=I('id');
        $user_id=$_SESSION['user_id'];
        
        $result=M('event')->where(array('id'=>$id,'report_id'=>$user_id))->find();
        $result['now']=time();
        $this->assign('result',$result);
      

        $this->display();
    }
    /**
     * 发布举报
     * 
     */
    public function ReleaseReport(){
        $is_authenticate=$_SESSION['user']['is_authenticate'];
        if($is_authenticate!=1){
            $this->error('请先完成认证','User/Authenticate');
        }
        if(IS_POST){
            $data['report_id']=$_SESSION['user']['id'];
            $data['report']=$_SESSION['user']['realname'];
            $data['title']=I('title');
            $data['bereport']=I('bereport');
            $data['betel']=I('betel');
            $data['addtime']=time();
            $data['native_place']=I('native_place');
            $data['content']=I('content');
            $upload=new \Think\Upload();
            $upload->maxSize=2097152;
            $upload->exts=array('rar','zip');
            $upload->rootPath='./public/upload/';
            $upload->savePath='Report/';
            $info=$upload->uploadOne($_FILES['file']);
            if(!$info){
                $this->error($upload->getError());
            }else{
                $data['image']=$info['savepath'].$info['savename'];
            }
            $result=M('event')->data($data)->add();
            if($result){
                $this->success('操作成功，请等待审核！');
            }else{
                $this->error('请稍后再试！');
            }
        }

        $this->display();
    }

    /**
     * 账户余额
     */
    public function MyMoney(){

        $this->display();
    }
    /**
     * 退出登录
     */
    
    public function Loginout(){
        session(null);
        $this->redirect('Index/index');
    }
    /**
     * 充值中心
     */
    public function UserPay(){
        
        $out_trade_no=strval(microtime(true))*10000;
        $this->assign('out_trade_no',$out_trade_no);
        $this->display();
    }
    /**
     * 上传身份证实名认证
     */
    public function Authenticate(){
        
        if(IS_POST){
            $data['evidence_id']=$_SESSION['user_id'];;
            $data['addtime']=time();
            $data['evidence_user']=$_SESSION['user']['realname'];
            $upload=new \Think\Upload();
            $upload->maxSize=2097152;
            $upload->exts=array('jpg','png','jpeg','gif');
            $upload->rootPath='./';
            $upload->savePath='public/upload/Authenticate/';
            $info=$upload->uploadOne($_FILES['photo']);
            if(!$info){
                $this->error($upload->getError());
            }else{
                $data['image']=$info['savepath'].$info['savename'];
            }
            $result=M('user_evidence')->data($data)->add();
            if($result){
                M('user')->where(array('id'=>$data['evidence_id']))->save(array('is_authenticate'=>2));
                $_SESSION['user']['is_authenticate']=2;
                $this->redirect('User/index');

            }else{
                $this->error('请稍后再试！');
            }
        }
        $this->display();
    }

    /**
     * 微信支付生成二维码地址
     */
    public function WeiXinPayCode(){

        $order=I('get.');

  
        weixinpay($order);
    }

    /**
     * 支付信息
     */
    public function UserRecharge(){
        $order=I('post.');
        $order['total_fee']=$order['total_fee']*100;
        $order['product_id']=$_SESSION['user_id'];
        $this->assign('order',$order);
        M('order')->data(array('out_trade_no'=>$order['out_trade_no'],'user_id'=>$order['product_id'],'total_fee'=>$order['total_fee']))->add();
        $this->display();
    }
    /**
     * 支付页面
     */
    public function WeiXinPaySet(){
        $time=microtime(true);
        $out_trade_no=strval($time);
        $user_id=$_SESSION['user_id'];
        $this->assign('out_trade_no',$out_trade_no);
        $this->assign('user_id',$user_id);

        $this->display();
    }
    /**
     * 退款申请
     */
    public function Cash(){
        if(IS_AJAX){
            $id=$_SESSION['user_id'];
            $data=I('post.');
            $data['user_id']=$id;
            $money=M('user')->where(array('id'=>$id))->getField("money");
            $data['addtime']=time();
            if($data['money']=='' || $data['account']==''){
                $this->ajaxReturn(array('code'=>0,'msg'=>'请将数据补充完整'));
                exit();

            }
            if($data['money'] > $money){
                $this->ajaxReturn(array('code'=>0,'msg'=>'可提现金额不足'));
                exit();
            }
            $result['money']=$money-$data['money'];
            if(M('cash')->data($data)->add()){
                $m1=M('user')->where(array('id'=>$id))->save($result);
                if($m1){
                    $this->ajaxReturn(array('code'=>1,'msg'=>'申请提交成功，我们将在3个工作日内完成退款'));
                }else{
                     $this->ajaxReturn(array('code'=>0,'msg'=>'请稍后再试'));
                }
            }else{
                $this->ajaxReturn(array('code'=>0,'msg'=>'请稍后再试'));
            }


        }

    }
      /**
     * 直接起诉页面
     */
    public function Sue(){
        $id=I('id');
        $this->assign('id',$id);
        $this->display();
    }
    /**
     * 评论
     */
    public function MyComment(){
        $user_id=$_SESSION['user_id'];
        $count=M('comment')->where(array('report_id'=>$user_id))->order("addtime desc")->count();
        $Page=new \Think\Page($count,10);
        $Page->setConfig('first','首页');
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $Page->setConfig('theme',' <ul class="pager "> <li> %FIRST%</li> <li> %LINK_PAGE% </li><li> %DOWN_PAGE%</li> ');
        $show=$Page->show();
        $list=M('comment')->where(array('report_id'=>$user_id))->limit($Page->firstRow.','.$Page->listRows)->order("addtime desc")->select();

        $this->assign('page',$show);
        $this->assign('list',$list);
        $this->display();

    }
    public function ChangePwd(){

        $this->display();
    }
}