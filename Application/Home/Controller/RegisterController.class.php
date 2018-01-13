<?php
namespace Home\Controller;
use Think\Controller;
class RegisterController extends Controller {
     public function _initialize(){
     
            $qrcode=M("image")->where("id > 8")->getField("id,image,address");//获取二维码
            $this->assign('qrcode',$qrcode);
            $base=M('config')->where(array('id'=>1))->find();//获取配置参数
            C($base);
            $link=M('blogroll')->where(array('state'=>1))->select();
          $this->assign('link',$link);
            if(isset($_SESSION['user_id'])){
                redirect(__ROOT__);
            }

        
    }
    /**
    用户注册
    **/
    public function Register(){

        if(IS_AJAX){
            $user=D("user");
            $tel=I('tel');
            $data=$user->create();
            $verify=I('verify');
            if($data['realname']=='' || $data['tel']=='' || $data['password']==''){
                $this->ajaxReturn(array('code'=>0,'msg'=>'请将数据补充完整'));
                exit();
            }
            if($verify!=$_SESSION['verify']){
                $this->ajaxReturn(array('code'=>0,'msg'=>'验证码错误'));
                exit();
            }elseif(!$data){
                $this->ajaxReturn($user->getError());
                exit();
            }elseif($_SESSION['tel']!=$tel){
                $this->ajaxReturn(array('code'=>0,'msg'=>'手机号与填写不一致'));
                exit();
            }else{
                $data['password']=md5($data['password']);
                $user->add($data);
                $result=M('user')->where(array('tel'=>$tel))->find();
                $_SESSION['user_id']=$result['id'];
                $_SESSION['user']=$result;
                $_SESSION['user_realname']=$result['realname'];
                $this->ajaxReturn(array('code'=>1,'msg'=>'注册成功'));
                exit();
            }
            // print_r($user->create());die();
        }
        $this->display();
    }
    // 发送短信验证码

    public function SendSMS(){


        if(IS_AJAX){
          

            $tel=I('tel');

            $state=M('user')->where(array('tel'=>$tel))->find();
            if($state){
                $this->ajaxReturn(array('code'=>0,'msg'=>'该手机号已注册','time'=>0));

          
                
            }
            $verify=mt_rand(1000,9999);//验证码范围
            $data['verify']=$verify;
            $time=time();
            $sendtime=$_SESSION['verify_time'];

            $result=$sendtime-$time;
            if($result>0){
                $this->ajaxReturn(array('code'=>2,'msg'=>'请求过于频繁','time'=>$result));
                exit();
              
            }
            $smsparam="{\"verify\":\"$verify\"}";
            $smstemplatecode="SMS_117280052";
            $resp=sendsms($smsparam,$smstemplatecode,$tel);
            $_SESSION['verify']=$verify;
            $_SESSION['tel']=$tel;
            $_SESSION['verify_time']=time()+120;
            $this->ajaxReturn(array($resp,$verify,'code'=>1,'time'=>120));
                // exit($callback.'('.json_encode( $resp).')');
               
           
           
        }

    }

    public function index(){
       
         $this->display();
    }
     
}