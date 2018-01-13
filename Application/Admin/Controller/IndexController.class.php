<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Upload;
class IndexController extends BaseController
    {
    public function index(){
        $logos=M('image')->select();
       
        $this->assign('logos',$logos);
        $this->display();
    }
    public function edit(){
        $id=I('id');
        $result=M('image')->where(array('id'=>$id))->find();
        $state= get_see_state();
        $this->assign('result',$result);
        $this->assign('state',$state);
        $this->display();
    }

    public function add(){
        if(IS_POST){
            $id=I('id');
            $data['address']=I('address');
            $data['addtime']=time();
            $data['is_see']=I('is_see');
            
                $width=1920;
                $height=500;
            
            if($_FILES['logo_img']['name']){//判断是否有文件上传
                $upload=new \Think\Upload();
                $upload->maxSize=2097152;
                $upload->exts=array('jpg','png','gif','jpeg');
                $upload->subName=array('date','Ymd');
                $upload->autoSub=true;  //自动创建子目录
                $upload->rootPath='./';
                $upload->savePath='public/upload/index/';
                $info=$upload->uploadOne($_FILES['logo_img']);
                if(!$info){
                        $this->error($upload->getError());
                    }else{
                        $image = new \Think\Image(); 
                        $image->open('./'.$info['savepath'].$info['savename']);
                        // 按照原图的比例生成一个最大为150*150的缩略图并保存为thumb.jpg
                        $image->thumb($width, $height,\Think\Image::IMAGE_THUMB_FIXED)->save('./'.$info['savepath'].'thumb'.$info['savename']);
                        $old_image=M('image')->where(array('id'=>$id))->getField('image');
                        if($old_image!=''){
                            unlink('./'.$old_image);//删除原图片
                        }
                        unlink('./'.$info['savepath'].$info['savename']);//删除上传的原图片，保留缩略图
                        $data['image']=$info['savepath'].'thumb'.$info['savename'];
                        

                }  
            }
            $result=M('image')->where(array('id'=>$id))->save($data);
            $this->redirect('Index/index');
        }
    }


}