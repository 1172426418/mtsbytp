<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Upload;
class PartnerController extends BaseController {

    public function index()
        {
            if(isset($_GET['city']) && $_GET['city']!=''){
                $city=I('city');
                $data['title']=array('like',"%$city%");
                $count=M('partner')->where($data)->count();
                $Page=new \Think\Page($count,13);
                $Page->setConfig('prev','上一页');
                $Page->setConfig('next','下一页');
                $Page->setConfig('theme',' <span>共<span> %TOTAL_ROW% </span>条记录</span><span style="padding-left:20px;">%FIRST%%UP_PAGE%%LINK_PAGE% %DOWN_PAGE%%END%
                                                  </span> ');
                $show=$Page->show();
                $list =M('partner')->where($data)->limit($Page->firstRow.','.$Page->listRows)->select();
                $this->assign('category_id',$category_id);
                $this->assign('show',$show);
                $this->assign('list',$list); 
            }else{
                $count=M('partner')->order("id desc")->count();
                $Page=new \Think\Page($count,13);
                $Page->setConfig('prev','上一页');
                $Page->setConfig('next','下一页');
                $Page->setConfig('theme',' <span>共<span> %TOTAL_ROW% </span>条记录</span><span style="padding-left:20px;">%FIRST%%UP_PAGE%%LINK_PAGE% %DOWN_PAGE%%END%
                                                  </span> ');
                $show=$Page->show();
                $list =M('partner')->limit($Page->firstRow.','.$Page->listRows)->select();
                $this->assign('show',$show);
                $this->assign('list',$list);
            }

            $this->display();
        }




    // public function add(){
    //     if(IS_POST){
          
    //         $data=I('post.');
    //         $data['addtime']=time();
    //         $m=M('news');
    //         $m->data($data)->add();
            
    //     }
    //     $category=M('category')->select();
    //     $this->assign('category',$category);
    //     $this->display();
    // }

    //案例编辑页面
    public function edit()
    {

        $id=I('id');
        //AR模式快捷查询
        $Partner=M('partner')->find($id);

        $this->assign('Partner',$Partner);
   

        $this->display();
    }
    public function del(){
        if(IS_GET){
            $id=I('id');
            $m=M('partner');
            
            $result=$m->where(array('id'=>$id))->delete();
        }
        $this->redirect('index');
    }

    //案例编辑处理页面
    public function edit_form()
    {
        if(IS_POST){
            $id=I('id');
            $data['title']=I('title');
            $data['content']=I('content');
            
            $M1=M('partner');

           
            $result=$M1->where(array('id'=>$id))->save($data);
        }

          $this->redirect('index');
            
       
        
    }

    public function category()//受理中的案例
        {

            $count=M('category')->count();
            $Page=new \Think\Page($count,15);
            $Page->setConfig('prev','上一页');
            $Page->setConfig('next','下一页');
            $Page->setConfig('theme',' <span>共<span> %TOTAL_ROW% </span>条记录</span><span style="padding-left:20px;">%FIRST%%UP_PAGE%%LINK_PAGE% %DOWN_PAGE%%END%
                                              </span> ');
            $show=$Page->show();
            $list =M('category')->limit($Page->firstRow.','.$Page->listRows)->select();
            
            $this->assign('show',$show);
            $this->assign('list',$list);
            $this->display();
        }
        //案例编辑页面
    public function category_edit()
    {
        if(IS_POST){
            $id=I('category_id');
            $data['category_name']=I('category_name');
            $result=M('category')->where(array('category_id'=>$id))->save($data);
            $this->redirect('category');
        }
        $id=I('id');
        $category=M('category')->where(array('category_id'=>$id))->find();
        $this->assign('category',$category);
        $this->display();
    }
   
}












