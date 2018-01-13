<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends BaseController {

    public function index(){
        if(isset($_GET['category_id'])){
            $category_id=I('category_id');
            $count=M('news')->where(array('category_id'=>$category_id))->order('addtime desc')->count();
            $Page=new \Think\Page($count,10);
            $Page->setConfig('prev','上一页');
            $Page->setConfig('next','下一页');
            $Page->setConfig('first','首页');
            $Page->setConfig('theme','<li>%FIRST%</li><li>%UP_PAGE%</li><li>%LINK_PAGE%</li><li>%DOWN_PAGE%</li>');
            $show=$Page->show();
            $list=M('news')->where(array('category_id'=>$category_id))->limit($Page->firstRow.','.$Page->listRows)->order('addtime desc')->select();
            $this->assign('category_id',$category_id);
            $this->assign('list',$list);
            $this->assign('page',$show);
        }elseif(isset($_GET['search'])){
            $search=I('search');
            $data['title']=array('like',"%$search%");
            $count=M('news')->where($data)->order('addtime desc')->count();
            $Page=new \Think\Page($count,10);
            $Page->setConfig('prev','上一页');
            $Page->setConfig('next','下一页');
            $Page->setConfig('first','首页');
            $Page->setConfig('theme','<li>%FIRST%</li><li>%UP_PAGE%</li><li>%LINK_PAGE%</li><li>%DOWN_PAGE%</li>');
            $show=$Page->show();
            $list=M('news')->where($data)->limit($Page->firstRow.','.$Page->listRows)->order('addtime desc')->select();
            $this->assign('list',$list);
            $this->assign('page',$show);
        }else{
            $count=M('news')->order('addtime desc')->count();
            $Page=new \Think\Page($count,10);
            $Page->setConfig('prev','上一页');
            $Page->setConfig('next','下一页');
            $Page->setConfig('first','首页');
            $Page->setConfig('theme','<li>%FIRST%</li><li>%UP_PAGE%</li><li>%LINK_PAGE%</li><li>%DOWN_PAGE%</li>');
            $show=$Page->show();
            $list=M('news')->limit($Page->firstRow.','.$Page->listRows)->order('addtime desc')->select();
            $this->assign('list',$list);
            $this->assign('page',$show);
        }




      
      $this->display();
    }
    public function details(){
      if(isset($_GET['partner'])){
        $partner=I('partner');
        $data['title']=array('like',"%$partner%");
        $result=M('partner')->where($data)->find();
        $this->assign('result',$result);

      }elseif(isset($_GET['news_id'])){
        $id=I('news_id');
        $result=M('news')->where(array('id'=>$id))->find();
        $this->assign('result',$result);
      }else{

      }

      $this->display();
    }
    public function linkus(){
        
      $result['title']="联系我们";
      $result['content']=M('config')->where(array('id'=>1))->getField("linkus");
      $this->assign('result',$result);
      $this->display();
    }
}