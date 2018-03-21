<?php
namespace Admin\Controller;
use Think\Controller;

class NewsController extends BaseController {

	public function index() {
		if (isset($_GET['category_id']) && $_GET['category_id'] != 'all') {
			$category_id = I('category_id');
			$count = M('news')->where(array('category_id' => $category_id))->order("id desc")->count();
			$Page = new \Think\Page($count, 10);
			$Page->setConfig('prev', '上一页');
			$Page->setConfig('next', '下一页');
			$Page->setConfig('theme', ' <span>共<span> %TOTAL_ROW% </span>条记录</span><span style="padding-left:20px;">%FIRST%%UP_PAGE%%LINK_PAGE% %DOWN_PAGE%%END%
                                                  </span> ');
			$show = $Page->show();
			$list = M('news')->where(array('category_id' => $category_id))->limit($Page->firstRow . ',' . $Page->listRows)->order("id desc")->select();
			$this->assign('category_id', $category_id);
			$this->assign('show', $show);
			$this->assign('list', $list);
		} else {
			$count = M('news')->order("id desc")->count();
			$Page = new \Think\Page($count, 10);
			$Page->setConfig('prev', '上一页');
			$Page->setConfig('next', '下一页');
			$Page->setConfig('theme', ' <span>共<span> %TOTAL_ROW% </span>条记录</span><span style="padding-left:20px;">%FIRST%%UP_PAGE%%LINK_PAGE% %DOWN_PAGE%%END%
                                                  </span> ');
			$show = $Page->show();
			$list = M('news')->limit($Page->firstRow . ',' . $Page->listRows)->order("id desc")->select();
			$this->assign('show', $show);
			$this->assign('list', $list);
		}
		$category = M('category')->select();
		$this->assign('category', $category);
		$this->display();
	}

	//分类标签管理
	public function menu() {
		$navigation = M('navigation')->where('pid=1')->select();
		foreach ($navigation as $k => $v) {
			$navigation[$k]['num'] = M('production')->where('navi_id=' . $v['id'])->count();
			$navigation[$k]['state_num'] = M('production')->where('navi_id=' . $v['id'] . ' && state=1 && is_moblie=0')->count();
			$navigation[$k]['is_moblie'] = M('production')->where('navi_id=' . $v['id'] . ' && state=1 && is_moblie=1')->count();
		}
		$this->assign('navigation', $navigation);
		$this->display();
	}

	public function add() {
		if (IS_POST) {

			$data = I('post.');
			$data['addtime'] = time();
			$m = M('news');
			$m->data($data)->add();

		}
		$category = M('category')->select();
		$this->assign('category', $category);
		$this->display();
	}

	//案例编辑页面
	public function edit() {

		$id = I('id');
		//AR模式快捷查询
		$news = M('news')->find($id);

		$category = M('category')->select();
		$this->assign('category', $category);
		$this->assign('news', $news);

		$this->display();
	}
	public function del() {
		if (IS_GET) {
			$id = I('id');
			$m = M('news');

			$result = $m->where(array('id' => $id))->delete();
		}
		$this->redirect('index');
	}

	//案例编辑处理页面
	public function edit_form() {
		if (IS_POST) {
			$id = I('id');
			$data['title'] = I('title');
			$data['content'] = I('content');
			$data['category_id'] = I('category_id');

			$M1 = M('news');

			$result = $M1->where(array('id' => $id))->save($data);
		}

		$this->redirect('index');

	}

	public function category() //受理中的案例
	{

		$count = M('category')->count();
		$Page = new \Think\Page($count, 15);
		$Page->setConfig('prev', '上一页');
		$Page->setConfig('next', '下一页');
		$Page->setConfig('theme', ' <span>共<span> %TOTAL_ROW% </span>条记录</span><span style="padding-left:20px;">%FIRST%%UP_PAGE%%LINK_PAGE% %DOWN_PAGE%%END%
                                              </span> ');
		$show = $Page->show();
		$list = M('category')->limit($Page->firstRow . ',' . $Page->listRows)->select();

		$this->assign('show', $show);
		$this->assign('list', $list);
		$this->display();
	}
	//案例编辑页面
	public function category_edit() {
		if (IS_POST) {
			$id = I('category_id');
			$data['category_name'] = I('category_name');
			$result = M('category')->where(array('category_id' => $id))->save($data);
			$this->redirect('category');
		}
		$id = I('id');
		$category = M('category')->where(array('category_id' => $id))->find();
		$this->assign('category', $category);
		$this->display();
	}
}
