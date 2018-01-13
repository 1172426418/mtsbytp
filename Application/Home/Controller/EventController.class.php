<?php
namespace Home\Controller;
use Think\Controller;
class EventController extends BaseController {
 

    /**
     * 发起保全令
     */
    public function ToSave()
    {
        if(IS_AJAX){
            $user_id=$_SESSION['user_id'];

            $id=I('id');
            $list=M("user")->where(array('id'=>$user_id))->find();
            $money=$list['money'];
            $save_money=C('save_money');
            if($money < $save_money){
                $this->ajaxReturn(array('code'=>2,'msg'=>'余额不足！'));
                exit();
            }
            $ac_money=$money-$save_money;
            $tel=$list['tel'];
            $expiry_date=strtotime("+3 days");
            $result=M('event')->where(array('id'=>$id,'betel'=>$tel))->save(array('state'=>0,'save_money'=>$save_money,'save_state'=>1,'expiry_date'=>$expiry_date));
            if($result){
                M('user')->where(array('id'=>$user_id))->save(array('money'=>$ac_money));
                $this->ajaxReturn(array('code'=>1,'msg'=>'操作成功，请等待举报方接令，如果3天内不接令，则该举报信息将自动删除'));
                exit();
            }else{
                $this->ajaxReturn(array('code'=>0,'msg'=>'请稍后再试'));
                exit();
            }

        }
    }
    /**
     * 接受保全令
     */
    public function AcSave()
    {
        if(IS_AJAX){
            $user_id=$_SESSION['user_id'];
            $id=I('id');
            $list=M("user")->where(array('id'=>$user_id))->find();
            $money=$list['money'];
            $save_money=M('event')->where(array('id'=>$id))->getField('save_money');
            if($money < $save_money){
                $this->ajaxReturn(array('code'=>0,'msg'=>'余额不足！'));
                exit();
            }
            $ac_money=$money-$save_money;
            $expiry_date='';
            $result=M('event')->where(array('id'=>$id,'report_id'=>$user_id))->save(array('state'=>0,'save_state'=>2,'expiry_date'=>$expiry_date));
            if($result){
                M('user')->where(array('id'=>$user_id))->save(array('money'=>$ac_money));
                $this->ajaxReturn(array('code'=>1,'msg'=>'操作成功，请等待平台审核'));
                exit();
            }else{
                $this->ajaxReturn(array('code'=>0,'msg'=>'请稍后再试'));
                exit();
            }

        }
    }
  
    /**直接起诉流程
     * 
     */
    public function ToSue(){
        if(IS_POST){
            $event_id=I('event_id');
            $user_id=$_SESSION['user_id'];
            $tel=M('user')->where(array('id'=>$user_id))->getField("tel");
            $data['save_state']=3;
            $data['state']=0;
            $upload=new \Think\Upload();
            $upload->maxSize=2097152;
            $upload->exts=array('zip','rar');
            $upload->rootPath='./';
            $upload->savePath='public/upload/Event/';
            $info=$upload->uploadOne($_FILES['photo']);
            if(!$info){
                $this->error($upload->getError());

            }else{
                $data['add_evidence']=$info['savepath'].$info['savename'];
                M('event')->where(array('id'=>$event_id,'betel'=>$tel))->save($data);
                $this->success('操作成功，请等待审核','/index.php/User/index');
            }

        }
    }
    /**
     * 删除已通过的举报案例
     */
    public function delevent(){
        if(IS_AJAX){
            $user_id=$_SESSION['user_id'];
            $event_id=I('id');
            $list=M('user')->where(array('id'=>$user_id))->find();
            if($list['money'] < 10){
                $this->ajaxReturn(array('code'=>0,'msg'=>'余额不足！'));
                exit();
            }
            $money=$list['money']-C('report_money');
            if(M('event')->where(array('id'=>$event_id,'report_id'=>$user_id,'state'=>1))->delete()){
                M('user')->where(array('id'=>$user_id))->save(array('money'=>$money));
                $this->ajaxReturn(array('code'=>1,'msg'=>'操作成功'));
                exit();
            }else{
                $this->ajaxReturn(array('code'=>0,'msg'=>'请稍后再试'));
                exit();
            }
        }
    }
}












