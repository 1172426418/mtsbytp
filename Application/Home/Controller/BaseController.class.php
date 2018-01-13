<?php
namespace Home\Controller;
use Think\Controller;
class BaseController extends Controller {
    public function _initialize(){
       //网站配置
      $config=M('config')->where(array('id'=>1))->find();
      $this->assign("config",$config);
              //轮播图
      $banner=M('image')->where(array('is_see'=>1))->select();
      $this->assign('banner',$banner);

      //横排导航
      $top_navigation=M('category')->where("category_id < 6")->select();
      $this->assign('top_navigation',$top_navigation);

      //竖排导航
      $left_navigation=M('category')->where("category_id > 5")->select();
      $this->assign('left_navigation',$left_navigation);
    }

}