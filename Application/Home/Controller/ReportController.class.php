<?php
namespace Home\Controller;
use Think\Controller;
class ReportController extends Controller {
    
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
        $count=M('event')->where(array('type'=>1,'state'=>1))->order("addtime desc")->count();
        $Page=new \Think\Page($count,10);
        $Page->setConfig('first','首页');
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $Page->setConfig('theme',' <ul class="pager "> <li> %FIRST%</li> <li> %LINK_PAGE% </li><li> %DOWN_PAGE%</li> ');
        $show=$Page->show();
        $list=M('event')->where(array('type'=>1,'state'=>1))->limit($Page->firstRow.','.$Page->listRows)->order("addtime desc")->select();

        $this->assign('list',$list);
        $this->assign('page',$show);
        $this->display();
    }


        /**
     * 发布举报
     */
    public function ReleaseReport(){
       $authenticate=$_SESSION['user']['is_authenticate'];
        if(IS_POST){
            $data['report_id']=$_SESSION['user_id'];;
            $data['report']=$_SESSION['user']['realname'];
            $data['type']=1;
            $data['title']=I('title');
            $data['bereport']=I('bereport');
            $data['betel']=I('betel');
            $data['content']=I('content');
            $data['beemail']=I('email');
            $data['native_place']=I('native_place');
            $data['addtime']=time();
            $data['becard']=I('becard');
            $data['see_tel']=I('see_tel');
            $data['see_qq']=I('see_qq');
            $data['see_name']=I('see_name');
            if($data['title']=='' || $data['bereport']=='' || $data['betel']=='' || $data['content']=='' || $data['beemail']=='' || $data['native_place']==''){
                $this->ajaxReturn(array('code'=>0,'msg'=>'请将数据补充完整！'));
                exit();
            }
            if($authenticate!=1){
                $this->ajaxReturn(array('code'=>0,'msg'=>'请先完成认证！'));
                exit();
            }
            if($data['becard']!=''){
                if(!validation_filter_id_card($data['becard'])){
                    $this->ajaxReturn(array('code'=>0,'msg'=>'请输入正确的身份证格式'));
                    exit();   
                }
            }
            $pattern = "/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i";
             if (!preg_match( $pattern, $data['beemail'])){
                $this->ajaxReturn(array('code'=>0,'msg'=>'请输入正确的邮箱格式'));
                exit();
             }
             if(!preg_match("/^1[34578]\d{9}$/", $data['betel'])){
                $this->ajaxReturn(array('code'=>0,'msg'=>'请输入正确的手机号'));
                exit();
            }
           if($_FILES['lefile']['name']){//判断是否有文件上传
                $upload=new \Think\Upload();
                $upload->maxSize=2097152;
                $upload->exts=array('rar','zip');
                $upload->subName=array('date','Ymd');
                $upload->autoSub=true;  //自动创建子目录
                $upload->rootPath='./';
                $upload->savePath='public/upload/Report/';
                $info=$upload->uploadOne($_FILES['lefile']);
                if(!$info){
                        $this->error($upload->getError());
                        
                    }else{
                       
                       
                        $data['image']=$info['savepath'].$info['savename'];
                       
                }  
            }
            $result=M('event')->data($data)->add();
            if($result){
               
                $this->success('操作成功，请等待审核！');
            }else{
                $this->error('请稍后再试');
            }
        }

       
    }
    public function Release(){
        if(!isset($_SESSION['user_id'])){
            redirect(__ROOT__.'/index.php/login/index.html');
        }
        $authenticate=$_SESSION['user']['is_authenticate'];
        if($authenticate!=1){
            redirect(__ROOT__.'/index.php/User/Authenticate.html');
        }
        $this->display();
    }
    public function pregReport(){
         if(IS_AJAX){
     
            $data['title']=I('title');
            $data['bereport']=I('bereport');
            $data['betel']=I('betel');
            $data['content']=I('content');
            $data['beemail']=I('email');
            $data['native_place']=I('native_place');
            if($data['title']=='' || $data['bereport']=='' || $data['betel']=='' || $data['content']=='' || $data['beemail']=='' || $data['native_place']==''){
                $this->ajaxReturn(array('code'=>0,'msg'=>'请将数据补充完整！'));
                exit();
            }
            $pattern = "/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i";
             if (!preg_match( $pattern, $data['beemail'])){
                $this->ajaxReturn(array('code'=>0,'msg'=>'请输入正确的邮箱格式'));
                exit();
             }
             if(!preg_match("/^1[34578]\d{9}$/", $data['betel'])){
                $this->ajaxReturn(array('code'=>0,'msg'=>'请输入正确的手机号'));
                exit();
            }
            $this->ajaxReturn(array('code'=>1,'msg'=>'ok'));
        }
    }
    public function details(){
        $id=I('id');
        $user_id=isset($_SESSION['user_id'])?$_SESSION['user_id']:'0';
        $result=M('event')->where(array('id'=>$id,'state'=>1))->find();
        if(!$result){
            $result=M('event')->where(array('id'=>$id,'report_id'=>$user_id))->find();
        }
        $this->assign('result',$result);
        //加入最近浏览
        if(isset($_SESSION['user_id'])){
            $user_id=$_SESSION['user_id'];
            $data['event_id']=$id;
            $data['user_id']=$user_id;
            $m=M('recent')->where($data)->find();
            if($m){
               M('recent')->where($data)->save(array('addtime'=>time())); 
            }else{
                $data['addtime']=time();
                M('recent')->data($data)->add();
            }
        }
        
        //获取最近浏览
        $recent=M('recent')->where(array('event_id'=>$id))->limit(20)->order("addtime desc")->select();
        //获取评论
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
        $this->assign('recent',$recent);
        $this->display();
    }
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












