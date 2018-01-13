<?php
    include "TopSdk.php";
    date_default_timezone_set('Asia/Shanghai'); 


    $c = new TopClient;
    $c ->appkey = '24705436' ;
    $c ->secretKey = '61035ee5437b770f64ef6b224f44a981' ;
    $req = new AlibabaAliqinFcSmsNumSendRequest;
    $req ->setExtend( "" );
    $req ->setSmsType( "normal" );
    $req ->setSmsFreeSignName( "xm陈思" );
    $req ->setSmsParam( "{\"verify\":\"1234\"}");
    $req ->setRecNum( "13297973635" );
    $req ->setSmsTemplateCode( "SMS_112885016" );
    $resp = $c ->execute( $req );
    print_r($resp);
?>