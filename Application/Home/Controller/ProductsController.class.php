<?php
namespace Home\Controller;

class ProductsController extends BaseController
{
    public function index()
    {
        $navi=M('navigation')->where('pid=2 && state=1')->select();
        $this->assign('navi',$navi);//显示导航

        //第一次进入默认选定第一个按钮
        $now_navi=$_GET['navi']?$_GET['navi']:$navi[0]['id'];
        $this->assign('now_navi',$now_navi);

        $length = 15;
        $nowpage = $_GET['id']?$_GET['id']:1;
        if($_GET['id']<=0){
            $nowpage = 1;
        }
        $num = M('production')->where('pid=2 && state=1 && navi_id='.$now_navi)->count();
        $pages = $num==0?1:ceil($num/$length);
        if($_GET['id']>$pages){
            $nowpage = $pages;
        }
        $offset = ($nowpage-1)*$length;
        $limit = $offset.','.$length;
        $products=M('production')->where('pid=2 && state=1 && navi_id='.$now_navi)->limit($limit)->select();

        $this->assign('products',$products);//当前分类下的内容
        $this->assign('nowpage',$nowpage); //当前页
        $this->assign('pages',$pages);     //总页数
        $this->assign('num',$num);         //总记录数
        $this->assign('limit',$limit);
        $this->display();
    }

    public function content($id)
    {
        $content=M('production')->where('id='.$id)->find();
        $this->assign('content',$content);
        $this->display();
    }
}