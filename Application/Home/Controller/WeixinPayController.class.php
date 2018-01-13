<?php
namespace Home\Controller;
use Think\Controller;
class WeixinPayController extends Controller{

	public function notify(){
	
    Vendor('Weixinpay.Weixinpay');
    $wxpay=new \Weixinpay();
    $result=$wxpay->notify();
    if ($result) {
    	
  //   	$path = "logs/";
		// if (!is_dir($path)){
		//     mkdir($path,0777);  // 创建文件夹test,并给777的权限（所有权限）
		// }
		// $content =json_encode($result);  // 写入的内容
		// $file = $path."test.txt"; 
		// file_put_contents($file,$content,FILE_APPEND); 
		$order=M('order')->where(array('out_trade_no'=>$result['out_trade_no']))->find();
			if($order){
			$money=M('user')->where(array('id'=>$order['user_id']))->getField('money');
	        M('user')->where(array('id'=>$order['user_id']))->save(array('money'=>$money+$result['total_fee']));
	        M('order')->where(array('out_trade_no'=>$result['out_trade_no']))->save(array('state'=>1));
	        }	
    	}
	}
	public function checkpay(){
		$out_trade_no=I('out_trade_no');
		
		$result=M('order')->where(array('out_trade_no'=>$out_trade_no,'state'=>1))->find();
		if($result){
			$this->ajaxReturn('success');
		}else{
			$this->ajaxReturn('failed');
		}
	}
}