<?php if (!defined('THINK_PATH')) exit();?><!--头部文件-->
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


<div class="wrapper">
    <!--左侧菜单栏-->
    <div id="men-left" class="sidebar" data-color="orange" data-image="../../assets/img/full-screen-image-3.jpg">

    <div class="logo">
        <a href="#" class="logo-text">
            梦淘沙创业家族
        </a>
    </div>
    <div class="logo logo-mini">
        <a href="#" class="logo-text">
            梦淘沙创业家族
        </a>
    </div>

    <div class="sidebar-wrapper">

        <div class="user">
            <div class="photo">
                <img src="/xmcy/public/img/logo.png" /><!--管理员照片-->
            </div>
            <div class="info">
                <a data-toggle="collapse" href="#collapseExample" class="collapsed">
                    <?php echo ($admin_data["truename"]); ?> , 您好
                    <!-- <b class="caret"></b> -->
                </a>
               <!--  <div class="collapse" id="collapseExample">
                    <ul class="nav">
                        <li><a href="/xmcy/admin.php/Oneself/update_data.html">修改个人资料</a></li>
                        <li><a href="/xmcy/admin.php/Oneself/update_pwd.html">修改登录密码</a></li>
                        <li class="quit"><a href="/xmcy/admin.php/Login/quit.html">退出登录</a></li>
                    </ul>
                </div> -->
            </div>
        </div>

        <ul class="nav">
       
                        <li class="Company">
                <a href="<?php echo U('Company/index');?>">
                    <i class="pe-7s-credit"></i>
                    <p>公司信息</p>
                </a>
            </li>
                 <li class="Index">
                <a href="/xmcy/admin.php/Index/index.html">
                    <i class="pe-7s-cash"></i>
                    <p>轮播图管理</p>
                </a>
            </li>
            
            <li class="News">
                <a class="News-a" data-toggle="collapse" href="#tablesExamples">
                    <i class="pe-7s-news-paper"></i>
                    <p>资讯管理
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse News-div" id="tablesExamples">
                    <ul class="nav">
                        <li class="News-index"><a href="<?php echo U('News/index');?>">资讯列表</a></li>
                        <li class="News-add"><a href="<?php echo U('News/add');?>">资讯添加</a></li>
                        <li class="News-category"><a href="<?php echo U('News/category');?>">资讯分类</a></li>
                        <!-- <li class="Industry-menu"><a href="/xmcy/admin.php/Industry/menu.html">添加案例</a></li> -->
                    </ul>
                </div>
            </li>

            <li class="Partner">
                <a class="Partner-a" data-toggle="collapse" href="#partnerExamples">
                    <i class="pe-7s-users"></i>
                    <p>合伙人体系管理
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse Partner-div" id="partnerExamples">
                    <ul class="nav">
                        <li class="Partner-index"><a href="<?php echo U('Partner/index');?>">城市列表</a></li>
                       <!--  <li class="Partner-edit_us"><a href="<?php echo U('Partner/edit_us');?>">联系我们</a></li> -->
                        <!-- <li class="Industry-menu"><a href="/xmcy/admin.php/Industry/menu.html">添加案例</a></li> -->
                    </ul>
                </div>
            </li>
          
          <!--   <li class="Blogroll">
                <a href="<?php echo U('Blogroll/index');?>">
                    <i class="pe-7s-smile"></i>
                    <p>友情链接</p>
                </a>
            </li> -->



            <li class="Oneself">
                <a class="Oneself-a" data-toggle="collapse" href="#pagesExamples">
                    <i class="pe-7s-config"></i>
                    <p>个人中心
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse Oneself-div" id="pagesExamples">
                    <ul class="nav">
                   <!--      <li class="Oneself-update_data"><a href="/xmcy/admin.php/Oneself/update_data.html">修改个人资料</a></li> -->
                        <li class="Oneself-update_pwd"><a href="/xmcy/admin.php/Oneself/update_pwd.html">修改登录密码</a></li>
                        <li class="quit"><a href="/xmcy/admin.php/Login/quit.html">退出登录</a></li>
                    </ul>
                </div>
            </li>

        </ul>
    </div>
    <div class="sidebar-background" style="background-image: url(/xmcy/public/img/effect/full-screen-image-3.jpg); display: block;"></div>
</div>
    <!--左侧菜单栏结束-->

    <div class="main-panel">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
				<div class="navbar-minimize">
					<button id="minimizeSidebar" class="btn btn-warning btn-fill btn-round btn-icon">
						<i class="fa fa-ellipsis-v visible-on-sidebar-regular"></i>
						<i class="fa fa-navicon visible-on-sidebar-mini"></i>
					</button>
				</div>
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">资讯管理</a>
                </div>
            </div>
        </nav>



        <div class="content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-12">
                        <div class="div_button" style="margin-bottom:5px;">
                          <!--   <form id="search_form" action="/xmcy/admin.php/Report/index.html" method="post">
                          
                            <input name="search" class="search" type="text" placeholder="搜索标题或作者">
                            <input class="search_button" type="button" value="搜索">
                     
                            </form> -->
                        </div>
                        <div class="card">
                            <div class="toolbar">
                                <!--        Here you can write extra buttons/actions for the toolbar              -->
                            </div>

                            <table id="bootstrap-table" class="table">
                                <thead>
                                <th class="text-center">ID</th>
                                <th class="text-center">分类名称</th>

                               
                                <th class="td-actions text-center" data-events="operateEvents" data-formatter="operateFormatter">管理</th>
                                </thead>
                                <tbody>
                                    <?php if(count($list) != '0'): if(is_array($list)): foreach($list as $key=>$v): ?><tr align="center">
                                    
                                         
                                      <td><?php echo ($v["category_id"]); ?></td>
                                        <td><?php echo ($v["category_name"]); ?></td>

                                        <td class="effect">
                                            <a href="<?php echo U('News/category_edit',array('id'=>$v['category_id']));?>"><img src="/xmcy/public/img/effect/update.png"  alt="查看" title="查看"></a>&nbsp;&nbsp;
                                            <!-- <img class="successful_delete" data-state="<?php echo ($v["id"]); ?>" data-id="<?php echo ($v["id"]); ?>" data-src="<?php echo U('News/del',array('id'=>$v['id']));?>" src="/xmcy/public/img/effect/delete.png" alt="删除资讯" title="删除资讯"> -->
                                        </td>
                                    </tr><?php endforeach; endif; ?>
                             

                                <tr class="text-center">
                                    <td colspan="8" class="paging">

                                          <?php echo ($show); ?>
                                    </td>
                                </tr>
                                   <?php else: ?>
                                        <tr align="center"><td colspan="4">暂无数据！</td> </tr><?php endif; ?>
                                </tbody>
                            </table>
                        </div><!--  end card  -->
                    </div> <!-- end col-md-12 -->
                </div> <!-- end row -->

            </div>
        </div>

        <!--底部文件-->
        <footer class="footer">
    <div class="container-fluid">
        <p class="copyright" align="center">
            CopyRight (C) 2017 梦淘沙创业家族 All Rights Reserved 版权所有 　 
        </p>
    </div>
</footer>
        <!--底部文件结束-->


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
	<!--  Bootstrap Table Plugin    -->
	<script src="/xmcy/public/js/bootstrap-table.js"></script>
	<!--  Plugin for DataTables.net  -->
	<script src="/xmcy/public/js/jquery.datatables.js"></script>
    <!--  Full Calendar Plugin    -->
    <script src="/xmcy/public/js/fullcalendar.min.js"></script>
    <!-- Light Bootstrap Dashboard Core javascript and methods -->
	<script src="/xmcy/public/js/light-bootstrap-dashboard.js"></script>
	<!--   Sharrre Library    -->
    <script src="/xmcy/public/js/jquery.sharrre.js"></script>
	<!-- Light Bootstrap Dashboard DEMO methods, don't include it in your project! -->
	<script src="/xmcy/public/js/demo.js"></script>

    <script src="/xmcy/public/js/new_js.js"></script>
<script>
    $('li.News').addClass('active');
    $('a.News-a').attr('aria-expanded','true');
    $('div.News-div').addClass('in');
    $('li.News-category').addClass('active');

    $('.search_button').click(function(){
            $('#search_form').submit();
    })
</script>
<script>
    $('#successful_up').click(function(){
        $('.user-check:checked').each(function(){
            var id=$(this).val();
            $.ajax({
                type:'post',
                url:"/xmcy/admin.php/Successful/successful_up",
                data:'id='+id+'&type=production',
                success:function(data){
                    if(data>0){
                        $('.select-state[data-id='+id+'] img').attr('src','/xmcy/public/img/effect/checked.png');
                    }
                }
            })
        })
    })

    $('#successful_down').click(function(){
        $('.user-check:checked').each(function(){
            var id=$(this).val();
            $.ajax({
                type:'post',
                url:"/xmcy/admin.php/Successful/successful_down",
                data:'id='+id+'&type=production',
                success:function(data){
                    if(data>0){
                        $('.select-state[data-id='+id+'] img').attr('src','/xmcy/public/img/effect/unchecked.png');
                    }
                }
            })
        })
    })

    //删除单个
    $('.successful_delete').click(function(){
        var url=$(this).attr('data-src');
            Double_button('确定要删除该资讯吗？',url);
    })

    //删除多个
    $('#successful_delete').click(function(){
        var id = '';
        $('.user-check:checked').each(function(){
            id = id+','+$(this).val();
        })
        if(id != ''){
            var url='/xmcy/admin.php/Successful/get_recycle/id/'+id;
            Double_button('真的要删除选中的案例吗？',url);
        }
    })

    $('.paging a').click(function(){
        var url=$(this).attr('src');
        $('#search_form').attr('action',url).submit().submit();
    })
</script>
<script>
    if("<?php echo ($post['navi_id']); ?>"){
        var data="<?php echo ($post['navi_id']); ?>";
        $('.navi_id option[value='+data+']').prop('selected','selected');
    }
    if("<?php echo ($post['state']); ?>"){
        var data="<?php echo ($post['state']); ?>";
        $('.state option[value='+data+']').prop('selected','selected');
    }
    if("<?php echo ($post['search']); ?>"){
        var data="<?php echo ($post['search']); ?>";
        $('.search').val(data);
    }
</script>
</html>