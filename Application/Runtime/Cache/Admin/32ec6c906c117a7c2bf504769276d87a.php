<?php if (!defined('THINK_PATH')) exit();?>﻿<!--头部文件-->
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>梦淘沙创业家族</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <!-- Canonical SEO -->
    <!--  Social tags      -->
    <meta name="keywords" content="creative tim, html dashboard, html css dashboard, web dashboard, bootstrap dashboard, bootstrap, css3 dashboard, bootstrap admin, light bootstrap dashboard, frontend, responsive bootstrap dashboard">
    <meta name="description" content="Forget about boring dashboards, get an admin template designed to be simple and beautiful.">
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="Light Bootstrap Dashboard PRO by Creative Tim">
    <meta itemprop="description" content="Forget about boring dashboards, get an admin template designed to be simple and beautiful.">
    <!-- Twitter Card data -->
    <meta name="twitter:card" content="product">
    <meta name="twitter:site" content="@creativetim">
    <meta name="twitter:title" content="Light Bootstrap Dashboard PRO by Creative Tim">
    <meta name="twitter:description" content="Forget about boring dashboards, get an admin template designed to be simple and beautiful.">
    <meta name="twitter:creator" content="@creativetim">
    <meta name="twitter:data1" content="Light Bootstrap Dashboard PRO by Creative Tim">
    <meta name="twitter:label1" content="Product Type">
    <meta name="twitter:data2" content="$29">
    <meta name="twitter:label2" content="Price">
    <!-- Bootstrap core CSS     -->
    <link href="/xmcy/public/css/bootstrap.min.css" rel="stylesheet" />
    <!--  Light Bootstrap Dashboard core CSS    -->
    <link href="/xmcy/public/css/light-bootstrap-dashboard.css" rel="stylesheet"/>
    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="/xmcy/public/css/demo.css" rel="stylesheet" />
    <!--     Fonts and icons     -->
    <link href="/xmcy/public/css/font-awesome.min.css" rel="stylesheet">
    <link href='/xmcy/public/css/685fd913f1e14aebad0cc9d3713ee469.css' rel='stylesheet' type='text/css'>
    <link href="/xmcy/public/css/pe-icon-7-stroke.css" rel="stylesheet" />

    <link href="/xmcy/public/css/new_css.css" rel="stylesheet" />

    <!--百度编辑器-->
    <script type="text/javascript" charset="utf-8" src="/xmcy/public/doc/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="/xmcy/public/doc/ueditor.all.min.js"> </script>
    <script type="text/javascript" charset="utf-8" src="/xmcy/public/doc/lang/zh-cn/zh-cn.js"></script>
</head>
<body>
<!--双按钮提示栏-->
<div id="header-success1">
    <h1></h1>
    <div align="center">
        <input class="yes" url="" type="button" value="确定">　
        <input class="no" url="" type="button" value="取消">
    </div>
</div>

<!--  单按钮提示栏 -->
<div id="header-success2">
    <h1></h1>
    <div align="center">
        <input class="yes" url="" type="button" value="确定">
    </div>
</div>

<div style="height:150px;" class="free_time">
    <h1></h1>
    <input type="text" class="data" placeholder="请输入标签名称" style="margin:20px 0 0 80px;height:25px;width:150px;padding-left:5px;" onkeyup="value=value.replace(/[^\S]+/g,'')">
    <div align="center">
        <input class="yes" data-id="" type="button" value="保存">　
        <input class="no" type="button" value="取消">
    </div>
</div>

<div class="modal fade bs-example-modal-sm" id="tip" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
       <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">提示信息</h4>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
    function tip(msg){
        $(".modal-body").html(msg);
        $('#tip').modal('toggle');
    }
</script>

<!-- //One_button('在线状态的案例无法删除，请先下线');
Double_button('真的要删除选中的案例吗？',url);
-->
<!--头部文件结束-->

<nav class="navbar navbar-transparent navbar-absolute">
    <div class="container">    
        <div class="navbar-header">
            <a class="navbar-brand" href="#">梦淘沙创业家族—无论大小，同样出色</a>
        </div>
    </div>
</nav>


<div class="wrapper wrapper-full-page">
    <div class="full-page login-page" data-color="orange" data-image="../../assets/img/full-screen-image-1.jpg">   
        
    <!--   you can change the color of the filter page using: data-color="blue | azure | green | orange | red | purple" -->
        <div class="content">
            <div class="container">
                <div class="row">                   
                    <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
                        <form id="login_form" method="#" action="#">
                            
                        <!--   if you want to have the card without animation please remove the ".card-hidden" class   -->
                            <div class="card card-hidden">
                                <div class="header text-center">登陆</div>
                                <div class="content">
                                    <div class="form-group">
                                        <label>登陆账号</label>
                                        <input name="username" type="text" placeholder="请输入登陆账号" class="form-control username" onkeyup="value=value.replace(/[^\S]+/g,'')">
                                    </div>
                                    <div class="form-group">
                                        <label>登陆密码</label>
                                        <input name="password" type="password" placeholder="请输入登陆密码" class="form-control password" onkeyup="value=value.replace(/[^\S]+/g,'')">
                                    </div>
                                    <div class="form-group" align="center">
                                        <label id="success"></label>
                                    </div>
                                </div>
                                <div class="footer text-center">
                                    <button id="login_submit" type="button" class="btn btn-fill btn-warning btn-wd">确定</button>
                                </div>
                            </div>
                                
                        </form>
                                
                    </div>                    
                </div>
            </div>
        </div>

    	<footer class="footer footer-transparent">
            <div class="container">
                <p class="copyright" align="center">
                   <!-- 2016 <a href="#">Creative Tim</a>, made with love for a better web -->
                   CopyRight (C) 2018 梦淘沙创业家族 All Rights Reserved 版权所有
                </p>
            </div>
        </footer>


        <div class="full-page-background" style="background-image: url(/xmcy/public/img/effect/full-screen-image-3.jpg); display: block;"></div>
    </div>                             
       
</div>



</body>
    
    <!--   Core JS Files and PerfectScrollbar library inside jquery.ui   -->
    <script src="/xmcy/public/js/jquery.min.js" type="text/javascript"></script>
    <script src="/xmcy/public/js/jquery-ui.min.js" type="text/javascript"></script>
	<script src="/xmcy/public/js/bootstrap.min.js" type="text/javascript"></script>
	
	
	<!--  Forms Validations Plugin -->
	<script src="/xmcy/public/js/jquery.validate.min.js"></script>
	
	<!--  Plugin for Date Time Picker and Full Calendar Plugin-->
	<script src="/xmcy/public/js/moment.min.js"></script>
	
    <!--  Date Time Picker Plugin is included in this js file -->
    <script src="/xmcy/public/js/bootstrap-datetimepicker.js"></script>
    
    <!--  Select Picker Plugin -->
    <script src="/xmcy/public/js/bootstrap-selectpicker.js"></script>
    
	<!--  Checkbox, Radio, Switch and Tags Input Plugins -->
	<script src="/xmcy/public/js/bootstrap-checkbox-radio-switch-tags.js"></script>
	
	<!--  Charts Plugin -->
	<script src="/xmcy/public/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="/xmcy/public/js/bootstrap-notify.js"></script>
    
    <!-- Sweet Alert 2 plugin -->
	<script src="/xmcy/public/js/sweetalert2.js"></script>
        
    <!-- Vector Map plugin -->
	<script src="/xmcy/public/js/jquery-jvectormap.js"></script>
	
    <!--  Google Maps Plugin    -->
    <script src="/xmcy/public/js/aa743e8f448a4792bad10d201a7080f6.js"></script>
	
	<!-- Wizard Plugin    -->
    <script src="/xmcy/public/js/jquery.bootstrap.wizard.min.js"></script>

    <!--  Datatable Plugin    -->
    <script src="/xmcy/public/js/bootstrap-table.js"></script>
    
    <!--  Full Calendar Plugin    -->
    <script src="/xmcy/public/js/fullcalendar.min.js"></script>
    
    <!-- Light Bootstrap Dashboard Core javascript and methods -->
	<script src="/xmcy/public/js/light-bootstrap-dashboard.js"></script>
	
	<!--   Sharrre Library    -->
    <script src="/xmcy/public/js/jquery.sharrre.js"></script>
	
	<!-- Light Bootstrap Dashboard DEMO methods, don't include it in your project! -->
	<script src="/xmcy/public/js/demo.js"></script>

<script>
    $('#login_submit').click(function(){
        $('#success').text('');
        var username=$('.username').val();
        var password=$('.password').val();
        if(username.length==''){
            $('#success').text('请输入登陆账号').css('color','red');
        }else if(password==''){
            $('#success').text('请输入登陆密码').css('color','red');
        }else{
            $.ajax({
                type:'post',
                url:"/xmcy/admin.php/Login/login",
                data:'username='+username+'&password='+password,
                success:function(data){
                    if(data=='no'){
                        $('#success').text('用户名或密码错误').css('color','red');
                    }else{
                        window.location.href='/xmcy/admin.php/Company/index.html';
                    }
                }
            })
        }
    })
</script>

    <script type="text/javascript">
        $().ready(function(){
            lbd.checkFullPageBackgroundImage();
            setTimeout(function(){
                // after 1000 ms we add the class animated to the login/register card
                $('.card').removeClass('card-hidden');
            }, 700)
        });
    </script>
    
</html>