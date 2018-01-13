<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Upload;
class PraiseController extends BaseController {
 
    public function index()
    {
        $count=M('event')->where(array('state'=>0,'type'=>2))->order("id desc")->count();
        $Page=new \Think\Page($count,10);
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $Page->setConfig('theme',' <span>共<span> %TOTAL_ROW% </span>条记录</span><span style="padding-left:20px;">%FIRST%%UP_PAGE%%LINK_PAGE% %DOWN_PAGE%%END%
                                          </span> ');
        $show=$Page->show();
        $list =M('event')->where(array('state'=>0,'type'=>2))->limit($Page->firstRow.','.$Page->listRows)->order("id desc")->select();
        
        $this->assign('show',$show);
        $this->assign('list',$list);
        $this->display();
    }
    public function pass_index()
    {
        $count=M('event')->where(array('state'=>1,'type'=>2))->order("id desc")->count();
        $Page=new \Think\Page($count,10);
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $Page->setConfig('theme',' <span>共<span> %TOTAL_ROW% </span>条记录</span><span style="padding-left:20px;">%FIRST%%UP_PAGE%%LINK_PAGE% %DOWN_PAGE%%END%
                                          </span> ');
        $show=$Page->show();
        $list =M('event')->where(array('state'=>1,'type'=>2))->limit($Page->firstRow.','.$Page->listRows)->order("id desc")->select();
        
        $this->assign('show',$show);
        $this->assign('list',$list);
        $this->display();
    }
    public function nopass_index()
    {
        $count=M('event')->where(array('state'=>2,'type'=>2))->order("id desc")->count();
        $Page=new \Think\Page($count,10);
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $Page->setConfig('theme',' <span>共<span> %TOTAL_ROW% </span>条记录</span><span style="padding-left:20px;">%FIRST%%UP_PAGE%%LINK_PAGE% %DOWN_PAGE%%END%
                                          </span> ');
        $show=$Page->show();
        $list =M('event')->where(array('state'=>2,'type'=>2))->limit($Page->firstRow.','.$Page->listRows)->order("id desc")->select();
        
        $this->assign('show',$show);
        $this->assign('list',$list);
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
        $upload->exts=array('jpg','gif','png','jpeg');  //允许上传文件的后缀
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
    public function edit()
    {
        // $this->assign('url',$_GET['type']);
        $id=I('id');
        $praise=M('event')->find($id);
        // $navigation=M('navigation')->where('pid=1')->select();
        // $report['report']=M('user')->where(array('id'=>$report['report_id']))->getField('realname');
        $state= get_report_state();
         $this->assign('action',$action_name);
        $this->assign('praise',$praise);
        $this->assign('state',$state);
        // $this->assign('navigation',$navigation);

        
        $this->display();
    }

    //案例编辑处理页面
    public function edit_form()
    {
        
        $id=I('praise_id');
        $data['state']=I('stas');
        if($data['state']==2){
            $user_id=M('event')->where(array('id'=>$id))->getField('report_id');
            $money=M('user')->where(array('id'=>$user_id))->getField('money');
            $save_money=M('event')->where(array('id'=>$id))->getField('save_money');
            // $name=M('user')->where(array('id'=>$user_id))->getField('realname');
            // $address='名声网的一条处理信息';
            // $title=M('event')->where(array('id'=>$id))->getField('title');
            M('user')->where(array('id'=>$user_id))->save(array('money'=>$money+$save_money));
            $result=M('event')->where('id='.$id)->save($data);
            //  $smsparam="{\"name\":\"$name\",\"address\":\"$address\",\"title\":\"$title\"}";
            //     $smstemplatecode="SMS_117170037";
            //     $resp=sendsms($smsparam,$smstemplatecode,$tel);
            
             // $list=M('event')->where(array('id'=>$id))->find();
             //  $cont='尊敬的用户您好，有一条关于您的表扬案例《'.$list['title'].'》经审核未通过，发布费用已返还账户。点击<a href="http://1.msw110.com">查看详情</a>';
             //  $smail=SendMail($list['beemail'],'您好，'.$list['bereport'].',有关于您的一条表扬信息未通过',$cont);
            if($result){
                $this->redirect('index');
                
            }else{
               $this->redirect('index');
                
            }
        }else{
            $result=M('event')->where('id='.$id)->save($data);
            $list=M('event')->where(array('id'=>$id))->find();
            if($list['beemail']!= ''){
            $cont='尊敬的用户您好，有一条关于您的表扬案例《'.$list['title'].'》已通过并成功发布到名声网。点击<a href="http://1.msw110.com">查看详情</a>';
            $smail=SendMail($list['beemail'],'您好，'.$list['bereport'].',有关于您的一条表扬信息已审核通过并发布',$cont);
            }
            $name=$list['bereport'];
            $title=$list['title'];
            $tel=$list['betel'];
            $smsparam="{\"name\":\"$name\",\"title\":\"$title\"}";
            $smstemplatecode="SMS_118580063";
            $resp=sendsms($smsparam,$smstemplatecode,$tel);

            if($smail){
                $this->redirect('index');
                
            }else{
               $this->redirect('index');
                
            }
        }
       
    }
    /**
     * 删除案例
     * @return [type] [description]
     */
    public function del(){
        if(IS_GET){
            $id=I('id');
            $type=I('type');
            $m=M('event');
            $result=$m->where(array('id'=>$id))->where('state=1 OR state=2')->delete();
            if($type==1){
                $url='pass_index';
            }elseif($type==2){
                $url='nopass_index';
            }else{
                $url='index';
            }
        }
        $this->redirect($url);
    }





}












