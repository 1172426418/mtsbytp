<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Upload;
class CompanyController extends BaseController
{
    public function index(){
        $message=M('config')->find();
        $this->assign('message',$message);
        $this->display();
    }

    public function edit(){
        if(IS_AJAX){
            $data=I('post.');
            $config=M('config');

            $result=$config->where(array('id'=>1))->save($data);
            if($result){
                return $this->ajaxReturn("修改成功");
            }else{
                return $this->ajaxReturn("系统繁忙。请稍后再试");
            }
            
        }

        
    }
    

}