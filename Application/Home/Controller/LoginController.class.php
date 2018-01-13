<?php
namespace Home\Controller;
use Think\Controller;
class LoginController extends Controller {

     public function _initialize(){
     
            $qrcode=M("image")->where("id > 8")->getField("id,image,address");//获取二维码
            $this->assign('qrcode',$qrcode);
            $base=M('config')->where(array('id'=>1))->find();//获取配置参数
            C($base);
            $link=M('blogroll')->where(array('state'=>1))->select();
            $this->assign('link',$link);

        
    }
    public function index(){
        if(isset($_SESSION['user_id'])){
                redirect(__ROOT__);
            }
        if(IS_AJAX){
            $data['tel']=I('tel');
            $data['password']=md5(I('password'));
            $result=M('user')->where($data)->find();
            if($result){
                $_SESSION['user_id']=$result['id'];
                $_SESSION['user']=$result;
                // $_SESSION['realname']=$$result['realname'];
                $this->ajaxReturn(array('code'=>1,'msg'=>'登陆成功'));
                exit();
            }else{
                $this->ajaxReturn(array('code'=>0,'msg'=>'用户名或密码错误！'));
                exit();
            }
            
        }
        $this->display();
    }
    public function pwd_reset(){
        if(isset($_SESSION['user_id'])){
                redirect(__ROOT__);
            }
        $this->display();
    }
    
    public function SendSMS(){


        if(IS_AJAX){
          

            $tel=I('tel');

            $state=M('user')->where(array('tel'=>$tel))->find();
            if(!$state){
                $this->ajaxReturn(array('code'=>0,'msg'=>'该手机号尚未注册','time'=>0));

          
                
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
            $_SESSION['pwd_verify']=$verify;
            $_SESSION['tel']=$tel;
            $_SESSION['verify_time']=time()+120;
            $this->ajaxReturn(array($resp,$verify,'code'=>1,'time'=>120));
                // exit($callback.'('.json_encode( $resp).')');
               
           
           
        }

    }

    public function pwdreset(){
        if(IS_AJAX){
            $tel=I('tel');
            $verify=I('verification');
            if(!M('user')->where(array('tel'=>$tel))){
                $this->ajaxReturn(array('code'=>0,'msg'=>'该手机号尚未注册'));
                exit();
            }
            if($verify!=$_SESSION['pwd_verify']){
                $this->ajaxReturn(array('code'=>0,'msg'=>'验证码错误'));
                exit();
            }
            $password=md5(I('password'));
            if(M('user')->where(array('tel'=>$tel))->save(array('password'=>$password))){
                $this->ajaxReturn(array('code'=>1,'msg'=>'重置密码成功！'));
                exit();
            }else{
                $this->ajaxReturn(array('code'=>0,'msg'=>'请稍后再试'));
                exit();
            }
        }
       
    }
     public function changepwd(){
        if(IS_AJAX){
            $user_id=$_SESSION['user_id'];
            $oldpwd=md5(I('oldpwd'));
            if(!M('user')->where(array('id'=>$user_id,'password'=>$oldpwd))->find()){
                $this->ajaxReturn(array('code'=>0,'msg'=>'原密码错误'));
                exit();
            }        
            $password=md5(I('password'));
            if(M('user')->where(array('id'=>$user_id))->save(array('password'=>$password))){
                $this->ajaxReturn(array('code'=>1,'msg'=>'修改密码成功！'));
                exit();
            }else{
                $this->ajaxReturn(array('code'=>0,'msg'=>'请稍后再试'));
                exit();
            }
        }
       
    }
}