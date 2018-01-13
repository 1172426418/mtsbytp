<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Upload;
class ReportController extends BaseController {

    public function index()
    {

        $count=M('event')->where(array('state'=>0,'type'=>1))->order("id desc")->count();
        $Page=new \Think\Page($count,10);
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $Page->setConfig('theme',' <span>共<span> %TOTAL_ROW% </span>条记录</span><span style="padding-left:20px;">%FIRST%%UP_PAGE%%LINK_PAGE% %DOWN_PAGE%%END%
                                          </span> ');
        $show=$Page->show();
        $list =M('event')->where(array('state'=>0,'type'=>1))->limit($Page->firstRow.','.$Page->listRows)->order("id desc")->select();
        
        $this->assign('show',$show);
        $this->assign('list',$list);
        $this->display();
    }
    public function pass_index()
    {

        $count=M('event')->where(array('state'=>1,'type'=>1))->order("id desc")->count();
        $Page=new \Think\Page($count,10);
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $Page->setConfig('theme',' <span>共<span> %TOTAL_ROW% </span>条记录</span><span style="padding-left:20px;">%FIRST%%UP_PAGE%%LINK_PAGE% %DOWN_PAGE%%END%
                                          </span> ');
        $show=$Page->show();
        $list =M('event')->where(array('state'=>1,'type'=>1))->limit($Page->firstRow.','.$Page->listRows)->order("id desc")->select();
        
        $this->assign('show',$show);
        $this->assign('list',$list);
        $this->display();
    }
    public function nopass_index()
    {

        $count=M('event')->where(array('state'=>2,'type'=>1))->order("id desc")->count();
        $Page=new \Think\Page($count,10);
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $Page->setConfig('theme',' <span>共<span> %TOTAL_ROW% </span>条记录</span><span style="padding-left:20px;">%FIRST%%UP_PAGE%%LINK_PAGE% %DOWN_PAGE%%END%
                                          </span> ');
        $show=$Page->show();
        $list =M('event')->where(array('state'=>2,'type'=>1))->limit($Page->firstRow.','.$Page->listRows)->order("id desc")->select();
        
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


    //案例编辑页面
    public function edit()
    {
        // $this->assign('url',$_GET['type']);
        $id=I('id');
        $report=M('event')->find($id);
        $navigation=M('navigation')->where('pid=1')->select();
        $report['report']=M('user')->where(array('id'=>$report['report_id']))->getField('realname');
        $state= get_report_state();
        $this->assign('report',$report);
        $this->assign('state',$state);
        $this->assign('navigation',$navigation);

        
        $this->display();
    }

    //案例编辑处理页面
    public function edit_form()
    {
        
        $id=I('report_id');
        $data['state']=I('stas');
        $list=M('event')->where('id='.$id)->find();
        $save_state=$list['save_state'];
        $data['save_state']=0;
        $result=M('event')->where('id='.$id)->save($data);
        
        $address=$list['native_place'];
        $name=$list['bereport'];
        $title=$list['title'];
        $tel=$list['betel'];
        $data['save_state']=0;
        if($result){
            if($data['state']==1){
                if($save_state==2){
                    $user_id=M('event')->where(array('id'=>$id))->getField('report_id');
                    $money=M('user')->where(array('id'=>$user_id))->getField('money');
                    $ac_money=$money+$list['save_money']*2;
                    M('user')->where(array('id'=>$user_id))->save(array('money'=>$ac_money));
                }
                $smsparam="{\"name\":\"$name\",\"address\":\"$address\",\"title\":\"$title\"}";
                $smstemplatecode="SMS_117170037";
                $resp=sendsms($smsparam,$smstemplatecode,$tel);
                //添加邮件发送
                $cont='尊敬的用户您好，有一条关于举报您的案例《'.$list['title'].'》已发布到名声网，将会对您的信誉造成影响。点击<a href="http://1.msw110.com">查看详情</a>';
                $smail=SendMail($list['beemail'],'您好，'.$list['bereport'].',有关于您的一条负面消息已发布',$cont);
                
            }
            if($data['state']==2){
                if($save_state==2){
                    
                    $money=M('user')->where(array('tel'=>$tel))->getField('money');
                    $ac_money=$money+$list['save_money']*2;
                    M('user')->where(array('tel'=>$tel))->save(array('money'=>$ac_money));
                }
             
            }
            $this->redirect('index');
            
        }else{
           $this->redirect('index');
            
        }
    }

    
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












