<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Upload;
class EvidenceController extends BaseController {

    public function index()//受理中的案例
        {

            $count=M('user_evidence')->where(array('state'=>0))->order("id desc")->count();
            $Page=new \Think\Page($count,10);
            $Page->setConfig('prev','上一页');
            $Page->setConfig('next','下一页');
            $Page->setConfig('theme',' <span>共<span> %TOTAL_ROW% </span>条记录</span><span style="padding-left:20px;">%FIRST%%UP_PAGE%%LINK_PAGE% %DOWN_PAGE%%END%
                                              </span> ');
            $show=$Page->show();
            $list =M('user_evidence')->where(array('state'=>0))->limit($Page->firstRow.','.$Page->listRows)->order("id desc")->select();
            
            $this->assign('show',$show);
            $this->assign('list',$list);
            $this->display();
        }

    public function pass_index()//已通过认证
        {

            $count=M('user_evidence')->where(array('state'=>1))->order("id desc")->count();
            $Page=new \Think\Page($count,10);
            $Page->setConfig('prev','上一页');
            $Page->setConfig('next','下一页');
            $Page->setConfig('theme',' <span>共<span> %TOTAL_ROW% </span>条记录</span><span style="padding-left:20px;">%FIRST%%UP_PAGE%%LINK_PAGE% %DOWN_PAGE%%END%
                                              </span> ');
            $show=$Page->show();
            $list =M('user_evidence')->where(array('state'=>1))->limit($Page->firstRow.','.$Page->listRows)->order("id desc")->select();
            
            $this->assign('show',$show);
            $this->assign('list',$list);
            $this->display();
        }
    public function nopass_index()//未通过认证
        {

            $count=M('user_evidence')->where(array('state'=>2))->order("id desc")->count();
            $Page=new \Think\Page($count,10);
            $Page->setConfig('prev','上一页');
            $Page->setConfig('next','下一页');
            $Page->setConfig('theme',' <span>共<span> %TOTAL_ROW% </span>条记录</span><span style="padding-left:20px;">%FIRST%%UP_PAGE%%LINK_PAGE% %DOWN_PAGE%%END%
                                              </span> ');
            $show=$Page->show();
            $list =M('user_evidence')->where(array('state'=>2))->limit($Page->firstRow.','.$Page->listRows)->order("id desc")->select();
            
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

        $id=I('id');
        //AR模式快捷查询
        $evidence=M('user_evidence')->find($id);

        $state= get_report_state();
        $this->assign('evidence',$evidence);
        $this->assign('state',$state);

        $this->display();
    }

    //案例编辑处理页面
    public function edit_form()
    {
        
        $id=I('id');
        $evidence_id=I('evidence_id');
        
        $data['state']=I('stas');
        if($data['state']==1){
            $M1=M('user_evidence');
            $M2=M('user');
            //事务操作
            $M1->startTrans();
            $result=$M1->where(array('id'=>$id))->save($data);
            $result2=$M2->where(array('id'=>$evidence_id))->save(array('is_authenticate'=>1));
            if($result || $result2){
                $M1->commit();
            }else{
                $M1->callback();
            }
        }elseif($data['state']==2){
             M('user_evidence')->where(array('id'=>$id))->save($data);
             M('user')->where(array('id'=>$evidence_id))->save(array('is_authenticate'=>0));
        }else{
            $this->redirect('index');
        }
        
       
            $this->redirect('index');
            
       
        
    }

 
}












