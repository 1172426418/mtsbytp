<?php
namespace Home\Controller;
use Think\Controller;
class AliPayController extends Controller{

	public function pay(){
        //商户订单号，商户网站订单系统中唯一订单号，必填
        $order=I('post.');
        $list['total_amount']=$order['total_fee'];
        $list['product_id']=$_SESSION['user_id'];

        $out_trade_no =strval(microtime(true))*10000;
        M('order')->data(array('out_trade_no'=>$out_trade_no,'user_id'=>$list['product_id'],'total_fee'=>$list['total_amount']))->add();

 
        //输出
        echo alipay($out_trade_no,'账户充值',$list['total_amount']);
    }
    public function notify(){

    	Vendor('Alipay.aop.AopClient');
        Vendor('Alipay.aop.request.AlipayTradePagePayRequest');
        $arr=$_POST;
        //日志调试
  //       $path = "logs/";
		// if (!is_dir($path)){
		//     mkdir($path,0777);  // 创建文件夹test,并给777的权限（所有权限）
		// }
		// $content =json_encode($arr);  // 写入的内容
		// $file = $path."test.txt"; 
		// file_put_contents($file,$content,FILE_APPEND); 
		$aop = new \AopClient();
		$config = C('ALIPAY_CONFIG');
        $aop->signType= $config['sign_type'];
		$aop->alipayrsaPublicKey = $config['alipay_public_key'];
		$result = $aop->rsaCheckV1($arr, $config['alipay_public_key'], $config['sign_type']);//验证来源
		if($result) {//验证成功


			$out_trade_no = $_POST['out_trade_no'];

			//支付宝交易号

			$trade_no = $_POST['trade_no'];

			//交易状态
			$trade_status = $_POST['trade_status'];

			$order=M('order')->where(array('out_trade_no'=>$out_trade_no))->find();//查询订单
		    if($_POST['trade_status'] == 'TRADE_FINISHED') {

				
		    }
		    else if ($_POST['trade_status'] == 'TRADE_SUCCESS') {//支付成功
				
				$money=M('user')->where(array('id'=>$order['user_id']))->getField('money');
		        M('user')->where(array('id'=>$order['user_id']))->save(array('money'=>$money+$order['total_fee']));
		        M('order')->where(array('out_trade_no'=>$order['out_trade_no']))->save(array('state'=>1));
		    }
			//——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
			echo "success";	//请不要修改或删除
		}else {
		    //验证失败
		    echo "fail";

		}
    }
}