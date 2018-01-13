<?php

/**
 * 获取案件状态
 * 
 * @param  string $id [description]
 * @return [type]     [description]
 */
    function get_report_state($id=""){
    	$state=array('受理中','已通过','未通过' );
    	if($id==""){
    		return $state;
    	}else{
    		switch ($id) {
            case 0:
                return $state[$id];
                break;
            case 1:
                return $state[$id];
                break;
            case 2:
                return $state[$id];
                break;
            default:
            	return '/';
            	break;
        	}
    	}
       
     
    }
    function get_event_byid($id){

      $event=M('event')->where(array('id'=>$id))->getField('title');
      return $event;
    }
    function get_tel_byid($id){

      $tel=M('user')->where(array('id'=>$id))->getField('tel');
      return $tel;
    }
     function get_qq_byid($id){

      $qq=M('user')->where(array('id'=>$id))->getField('qq');
      return $qq;
    }
     function get_user_byid($id){
        $user=M('user')->where(array('id'=>$id))->getField('realname');
        return $user;
    }
    
    function get_categoryname_byid($id){
       $category_name=M('category')->where(array('category_id'=>$id))->getField('category_name');
       return $category_name;
    } 
    function get_paytype_byid($id){
      switch ($id) {
        case '1':
          return '微信';
          break;
        
        default:
          return '支付宝';
          break;
      }
    }
    /**
     * 获取广告展示状态
     * 
     * @param  string $id [description]
     * @return [type]     [description]
     */
    function get_see_state($id=""){
      $state=array('否','是');
      if($id==""){
        return $state;
      }else{
        switch ($id) {
            case 0:
                return $state[$id];
                break;
            case 1:
                return $state[$id];
                break;
            default:
              return '/';
              break;
          }
      }
       
     
    }

    /**
     * 获取案件保全令状态
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
      function get_save_state($id){
      	$state=array('被举报人未发起保全令','被举报人已发起保全令','举报人已接受保全令','直接起诉' );
      	if($id==""){
    		return $state;
		}else{
	        switch ($id) {
	            case 0:
	                return $state[$id];
	                break;
	            case 1:
	                return $state[$id];
	                break;
	            case 2:
	                return $state[$id];
              default:
                  return $state[$id];
	                break;
	            
	        } 
    	}
    }
    /**
     * 获取案件状态
     * 
     * @param  [type] $date [description]
     * @return [type]       [description]
     */
    	function get_expiry_date($date){
    		if($date==0){
    			return "永久";
    		}else{
    			return date("Y-m-d H:i:s",$date);
    		}
    	}
        /**
     * 微信扫码支付
     * @param  array $order 订单 必须包含支付所需要的参数 body(产品描述)、total_fee(订单金额)、out_trade_no(订单号)、product_id(产品id)
     */
    function weixinpay($order){
        $order['trade_type']='NATIVE';
        Vendor('Weixinpay.Weixinpay');
        $weixinpay=new \Weixinpay();
        $weixinpay->pay($order);
    }
    /**
     * 支付宝支付
     * @param [type] $[name] [<description>]
     */
    function alipay($out_trade_no,$proName,$total_amount){
        
        //订单名称，必填

        //商品描述，可空
        $body =trim('用于用户充值');//trim($_POST['WIDbody']);
        Vendor('Alipay.aop.AopClient');
        Vendor('Alipay.aop.request.AlipayTradePagePayRequest');
        //请求
        $c = new \AopClient();
        $config = C('ALIPAY_CONFIG');
        $c->gatewayUrl = "https://openapi.alipay.com/gateway.do";
        $c->appId = $config['app_id'];
        $c->rsaPrivateKey = $config['merchant_private_key'];
        $c->format = "json";
        $c->charset= "utf-8";
        $c->signType= $config['sign_type'];;
        $c->alipayrsaPublicKey = $config['alipay_public_key'];
        $request = new \AlipayTradePagePayRequest();
        $request->setReturnUrl($config['return_url']);
        $request->setNotifyUrl($config['notify_url']);
        $list=array(
          'product_code'=>'FAST_INSTANT_TRADE_PAY',
          'subject'=>$proName,
          'out_trade_no'=>$out_trade_no,
          'total_amount'=>$total_amount,
          'body'=>$body
        );
        $list=json_encode($list);
        $request->setBizContent($list);
        return $result = $c->pageExecute ($request);
    }
    /**
     * 发送短信验证码
     * @param $smsparam json短信变量数据
     * @param $smstemplatecode 短信模板编号
     */
    function sendsms($smspram,$smstemplatecode,$tel){
        Vendor('SendSMS.TopSdk');
        $c = new \TopClient;
        $c ->appkey = '24731005' ;
        $c ->secretKey = '63bceed7e2c56c3d609389e7758eecde' ;
        $req = new \AlibabaAliqinFcSmsNumSendRequest;
        $req ->setExtend( "" );
        $req ->setSmsType( "normal" );
        $req ->setSmsFreeSignName( "名声网" );
        $req ->setSmsParam($smspram);
        $req ->setRecNum( $tel );
        $req ->setSmsTemplateCode($smstemplatecode);
        return $c->execute( $req );

    }
    function qrcode($url,$size=4){
    Vendor('Phpqrcode.phpqrcode');
    QRcode::png($url,false,QR_ECLEVEL_L,$size,2,false,0xFFFFFF,0x000000);exit();
}

/**
 * 邮件发送函数
 */
function SendMail($to, $title, $content) {
              Vendor('PHPMailer.PHPMailerAutoload');     
              $mail = new \PHPMailer(); //实例化
              $mail->IsSMTP(); // 启用SMTP
              $mail->SMTPSecure = 'ssl';
              $mail->Host=C('MAIL_HOST'); //smtp服务器的名称（这里以QQ邮箱为例）
              $mail->Port = 465;
              $mail->SMTPAuth = C('MAIL_SMTPAUTH'); //启用smtp认证
              $mail->Username = C('MAIL_USERNAME'); //你的邮箱名
              $mail->Password = C('MAIL_PASSWORD') ; //邮箱密码
              $mail->From = C('MAIL_FROM'); //发件人地址（也就是你的邮箱地址）
              $mail->FromName = C('MAIL_FROMNAME'); //发件人姓名
              $mail->AddAddress($to,"尊敬的客户");
              $mail->WordWrap = 50; //设置每行字符长度
              $mail->IsHTML(C('MAIL_ISHTML')); // 是否HTML格式邮件
              $mail->CharSet=C('MAIL_CHARSET'); //设置邮件编码
              $mail->Subject =$title; //邮件主题
              $mail->Body = $content; //邮件内容
              $mail->AltBody = "这是一个纯文本的身体在非营利的HTML电子邮件客户端"; //邮件正文不支持HTML的备用显示
              return($mail->Send());
              //return $mail->ErrorInfo;
              //$mail->ErrorInfo;
          }
 /**
  * 检测手机端
  */
function ismobile() {
    // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
    if (isset ($_SERVER['HTTP_X_WAP_PROFILE']))
        return true;
    
    //此条摘自TPM智能切换模板引擎，适合TPM开发
    if(isset ($_SERVER['HTTP_CLIENT']) &&'PhoneClient'==$_SERVER['HTTP_CLIENT'])
        return true;
    //如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
    if (isset ($_SERVER['HTTP_VIA']))
        //找不到为flase,否则为true
        return stristr($_SERVER['HTTP_VIA'], 'wap') ? true : false;
    //判断手机发送的客户端标志,兼容性有待提高
    if (isset ($_SERVER['HTTP_USER_AGENT'])) {
        $clientkeywords = array(
            'nokia','sony','ericsson','mot','samsung','htc','sgh','lg','sharp','sie-','philips','panasonic','alcatel','lenovo','iphone','ipod','blackberry','meizu','android','netfront','symbian','ucweb','windowsce','palm','operamini','operamobi','openwave','nexusone','cldc','midp','wap','mobile'
        );
        //从HTTP_USER_AGENT中查找手机浏览器的关键字
        if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT']))) {
            return true;
        }
    }
    //协议法，因为有可能不准确，放到最后判断
    if (isset ($_SERVER['HTTP_ACCEPT'])) {
        // 如果只支持wml并且不支持html那一定是移动设备
        // 如果支持wml和html但是wml在html之前则是移动设备
        if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html')))) {
            return true;
        }
    }
    return false;
}

/**
 * 验证身份证是否有效
 */
function validation_filter_id_card($id_card){
    if(strlen($id_card)==18){
        return idcard_checksum18($id_card);
    }elseif((strlen($id_card)==15)){
        $id_card=idcard_15to18($id_card);
        return idcard_checksum18($id_card);
    }else{
        return false;
    }
}
// 计算身份证校验码，根据国家标准GB 11643-1999
function idcard_verify_number($idcard_base){
    if(strlen($idcard_base)!=17){
        return false;
    }
    //加权因子
    $factor=array(7,9,10,5,8,4,2,1,6,3,7,9,10,5,8,4,2);
    //校验码对应值
    $verify_number_list=array('1','0','X','9','8','7','6','5','4','3','2');
    $checksum=0;
    for($i=0;$i<strlen($idcard_base);$i++){
        $checksum += substr($idcard_base,$i,1) * $factor[$i];
    }
    $mod=$checksum % 11;
    $verify_number=$verify_number_list[$mod];
    return $verify_number;
}
// 将15位身份证升级到18位
function idcard_15to18($idcard){
    if(strlen($idcard)!=15){
        return false;
    }else{
        // 如果身份证顺序码是996 997 998 999，这些是为百岁以上老人的特殊编码
        if(array_search(substr($idcard,12,3),array('996','997','998','999')) !== false){
            $idcard=substr($idcard,0,6).'18'.substr($idcard,6,9);
        }else{
            $idcard=substr($idcard,0,6).'19'.substr($idcard,6,9);
        }
    }
    $idcard=$idcard.idcard_verify_number($idcard);
    return $idcard;
}
// 18位身份证校验码有效性检查
function idcard_checksum18($idcard){
    if(strlen($idcard)!=18){
        return false;
    }
    $idcard_base=substr($idcard,0,17);
    if(idcard_verify_number($idcard_base)!=strtoupper(substr($idcard,17,1))){
        return false;
    }else{
        return true;
    }
}