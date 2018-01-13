<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Upload;
class CaseController extends BaseController {

    public function index()
        {

            $count=M('case')->order("id desc")->count();
            $Page=new \Think\Page($count,10);
            $Page->setConfig('prev','上一页');
            $Page->setConfig('next','下一页');
            $Page->setConfig('theme',' <span>共<span> %TOTAL_ROW% </span>条记录</span><span style="padding-left:20px;">%FIRST%%UP_PAGE%%LINK_PAGE% %DOWN_PAGE%%END%
                                              </span> ');
            $show=$Page->show();
            $list =M('case')->limit($Page->firstRow.','.$Page->listRows)->order("id desc")->select();
            
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

    public function add(){
        if(IS_POST){
          
            $data=I('post.');
            $data['addtime']=time();
            $m=D('case');
            if($_FILES['logo']['name']){//判断是否有文件上传
                $upload=new \Think\Upload();
                $upload->maxSize=2097152;
                $upload->exts=array('jpg','png','gif','jpeg');
                $upload->subName=array('date','Ymd');
                $upload->autoSub=true;  //自动创建子目录
                $upload->rootPath='./';
                $upload->savePath='public/upload/case/';
                $info=$upload->uploadOne($_FILES['logo']);
                if(!$info){
                        $this->error($upload->getError());
                    }else{
                        $image = new \Think\Image(); 
                        $image->open('./'.$info['savepath'].$info['savename']);
                        // 按照原图的比例生成一个最大为150*150的缩略图并保存为thumb.jpg
                        $image->thumb(330, 180,\Think\Image::IMAGE_THUMB_FIXED)->save('./'.$info['savepath'].'thumb'.$info['savename']);
                        unlink('./'.$info['savepath'].$info['savename']);
                        $data['image']=$info['savepath'].'thumb'.$info['savename'];
                       
                }  
            }
          
            
            if(!$m->create($data)){
                $this->error($m->getError(),'add');
            }else{
                $m->add($data);
            }
        }
        $this->display();
    }

    //案例编辑页面
    public function edit()
    {

        $id=I('id');
        //AR模式快捷查询
        $case=M('case')->find($id);

        
        $this->assign('case',$case);
   

        $this->display();
    }
    public function del(){
        if(IS_GET){
            $id=I('id');
            $m=M('case');
            $upload=$m->where(array('id'=>$id))->getField('image');
            unlink("./".$upload);
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
            $data['froms']=I('froms');
            $M1=M('case');

            if($_FILES['logo']['name']){//判断是否有文件上传
                $upload=new \Think\Upload();
                $upload->maxSize=2097152;
                $upload->exts=array('jpg','png','gif','jpeg');
                $upload->subName=array('date','Ymd');
                $upload->autoSub=true;  //自动创建子目录
                $upload->rootPath='./';
                $upload->savePath='public/upload/case/';
                $info=$upload->uploadOne($_FILES['logo']);
                if(!$info){
                        $this->error($upload->getError());
                    }else{
                        $image = new \Think\Image(); 
                        $image->open('./'.$info['savepath'].$info['savename']);
                        // 按照原图的比例生成一个最大为150*150的缩略图并保存为thumb.jpg
                        $image->thumb(330, 180,\Think\Image::IMAGE_THUMB_FIXED)->save('./'.$info['savepath'].'thumb'.$info['savename']);
                        $data['image']=$info['savepath'].'thumb'.$info['savename'];
                      
                        $upload=$M1->where(array('id'=>$id))->getField('image');
                        unlink('./'.$upload);
                }  
            }
       
            $result=$M1->where(array('id'=>$id))->save($data);
        }

          $this->redirect('index');
            
       
        
    }

 
}












