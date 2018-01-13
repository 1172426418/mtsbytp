<?php
namespace Admin\Model;
use Think\Model;
class NewsModel extends Model{
	protected $_validate=array(
		array('title','require','标题为必填'),
		array('froms','require','来源为必填'),
		array('content','require','内容为必填'),

	);
}