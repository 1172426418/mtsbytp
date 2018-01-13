<?php
namespace Home\Model;
use Think\Model;
class UserModel extends Model{
	protected $_validate=array(
		array('tel','','手机号已存在',0,'unique',1),
		// array('password','require','密码为必填'),
		// array('repassword','password','确认密码不正确',0,'confirm'),
	);
}