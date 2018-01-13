<?php
namespace Home\Controller;

class DynamicController extends BaseController {
    public function index(){
        $length = 10;
        $nowpage = $_GET['id']?$_GET['id']:1;
        if($_GET['id']<=0){
            $nowpage = 1;
        }

        $num = M('dynamic')->where('state=1')->count();
        $pages = $num==0?1:ceil($num/$length);

        if($_GET['id']>$pages){
            $nowpage = $pages;
        }
        $offset = ($nowpage-1)*$length;
        $limit = $offset.','.$length;
        $dy=M('dynamic')->where('state=1')->limit($limit)->select();

       foreach($dy as $k=>$v){
           $dy[$k]['date']=date('Y-m-d',$v['date']);
       }
       $this->assign('dy',$dy);
        $this->assign('nowpage',$nowpage); //当前页
        $this->assign('pages',$pages);     //总页数
        $this->assign('num',$num);         //总记录数
        $this->assign('limit',$limit);
        $this->display();
    }

    public function content($id)
    {
        $content=M('dynamic')->where('id='.$id)->find();
        $content['date']=date('Y-m-d',$content['date']);
        $this->assign('content',$content);
        $this->display();
    }
}