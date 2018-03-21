<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <meta name="keywords" content="梦淘沙,创业,创业家族,创新,mengtaosha,梦淘沙创业家族" />
    <meta name="description" content="梦淘沙：让年轻成为你的资本，试着发现生活中的美。调整心态保持品味，用心经营青春无悔。" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge,chrome=1">
    <link rel="icon" href="/xmcy/public/home/img/x-icon.png" type="image/x-icon" />
    <link rel="stylesheet" href="/xmcy/public/home/css/bootstrap.min.css">
    <link rel="stylesheet" href="/xmcy/public/home/css/common.css">
    <link rel="stylesheet" href="/xmcy/public/home/css/index.css">
    <title> <?php if($result["title"] == ''): ?>梦淘沙创业家族<?php else: echo ($result["title"]); endif; ?></title>
</head>

<body>



    <section class="header">


        <!-- logo -->
        <div class="logo">
            <img class="img-responsive center-block" src="/xmcy/public/home/img/logo_text.jpg" alt="">
        </div>
<div class="c-e">
    


        <!-- 轮播 -->
        <div id="carousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#carousel" data-slide-to="0" class="active"></li>
                <li data-target="#carousel" data-slide-to="1"></li>
                <li data-target="#carousel" data-slide-to="2"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
              <?php if(is_array($banner)): foreach($banner as $k=>$vo): ?><div class="item <?php if($k == 0): ?>active<?php endif; ?>">
                    <img src="/xmcy/<?php echo ($vo["image"]); ?>" alt="...">

                </div><?php endforeach; endif; ?>
               <!--  <div class="item active">
                    <img src="/xmcy/public/home/img/banner1.jpg" alt="...">

                </div>
                <div class="item">
                    <img src="/xmcy/public/home/img/banner1.jpg" alt="...">

                </div>
                <div class="item">
                    <img src="/xmcy/public/home/img/banner1.jpg" alt="...">

                </div> -->

            </div>
        </div>
</div>

    </section>




    <section class="content">
        <div class="c-e">
            <!-- 搜索 -->
            <form class="search" action="<?php echo U('Index/index');?>" method="get">


                <div class="input-group">

                    <input type="text" name="search" class="form-control" placeholder="全站搜索">

                    <span class="input-group-btn">
                        <input class="btn btn-default" type="submit" value="">
                    </span>
                </div>


            </form>


            <!-- 导航 -->
            <article class="clear">
                <!-- 导航左 -->
                <nav class="nav-left">
                    <ul>
                        <li>
                            产业分类
                        </li>

                        <?php if(is_array($left_navigation)): foreach($left_navigation as $key=>$vo): ?><li <?php if($category_id == $vo['category_id']): ?>class="left-active"<?php endif; ?> >
                            <a href="<?php echo U('Index/index',array('category_id'=>$vo['category_id']));?>"><?php echo ($vo["category_name"]); ?></a>
                            </li><?php endforeach; endif; ?>
                        <!-- <li class="left-active">
                            <a href="">农业</a>
                        </li>
                        <li>
                            <a href="">文化</a>
                        </li>
                        <li>
                            <a href="">健康</a>
                        </li>
                        <li>
                            <a href="">网络</a>
                        </li>
                        <li>
                            <a href="">金融</a>
                        </li>
                        <li>
                            <a href="">智能</a>
                        </li>
                        <li>
                            <a href="">旅游</a>
                        </li> -->
                    </ul>
                </nav>

                <!-- 导航上 -->
                <nav class="nav-top">
                    <ul>
                        <li <?php if($category_id == ''): ?>class="top-active"<?php endif; ?> >
                            <a href="/xmcy">网站首页</a>
                        </li>
                        <?php if(is_array($top_navigation)): foreach($top_navigation as $key=>$vo): ?><li <?php if($category_id == $vo['category_id']): ?>class="top-active"<?php endif; ?> >
                            <a href="<?php echo U('Index/index',array('category_id'=>$vo['category_id']));?>"><?php echo ($vo["category_name"]); ?></a>
                            </li><?php endforeach; endif; ?>
                     <!--    <li>
                            <a href="">微品牌</a>
                        </li>
                        <li>
                            <a href="">微流量</a>
                        </li>
                        <li>
                            <a href="">微商圈</a>
                        </li>
                        <li>
                            <a href="">精彩资讯</a>
                        </li>
                        <li>
                            <a href="">商学院</a>
                        </li> -->
                        <li>
                            <a href="<?php echo U('Index/linkus');?>">联系我们</a>
                        </li>
                    </ul>
                </nav>

                <!-- 内容区 -->
                <article class="cont-box">
                    <!-- 内容 -->
                    <div class="news">
                        <ul>

                            <?php if(is_array($list)): foreach($list as $key=>$vo): ?><li>
                                    <a href="<?php echo U('Index/details',array('news_id'=>$vo['id']));?>">
                                        <span><?php echo ($vo["title"]); ?></span>
                                        <span><?php echo (date('Y-m-d H:i:s',$vo["addtime"])); ?></span>
                                    </a>
                                </li><?php endforeach; endif; ?>
                           <!--  <li>
                                <a href="http://">
                                    <span>世界上最会赚钱的人</span>
                                    <span>2011-9-1 9:52:45</span>
                                </a>
                            </li>
                            <li>
                                <a href="http://">
                                    <span>世界上最会赚钱的人</span>
                                    <span>2011-9-1 9:52:45</span>
                                </a>
                            </li>
                            <li>
                                <a href="http://">
                                    <span>世界上最会赚钱的人</span>
                                    <span>2011-9-1 9:52:45</span>
                                </a>
                            </li>
                            <li>
                                <a href="http://">
                                    <span>世界上最会赚钱的人</span>
                                    <span>2011-9-1 9:52:45</span>
                                </a>
                            </li> -->
                        </ul>
                    </div>

                    <!-- 分页 -->
                    <div class="pages">
                        <ul class="pager">
                            <?php echo ($page); ?>
                           <!--  <li>
                                <a href="#">首页</a>
                            </li>
                            <li>
                                <a href="#">上一页</a>
                            </li>
                            <li class="page-active">
                                <a href="#">1</a>
                            </li>
                            <li>
                                <a href="#">2</a>
                            </li>
                            <li>
                                <a href="#">3</a>
                            </li>
                            <li>
                                <a href="#">4</a>
                            </li>
                            <li>
                                <a href="#">5</a>
                            </li>
                            <li>
                                <a href="#">下一页</a>
                            </li> -->
                        </ul>
                    </div>
                </article>


            </article>


        </div>
    </section>

    <section class="maps">
        <h1>合伙人体系</h1>
        <div class="map">
                <img src="/xmcy/public/home/img/map/map.jpg" width="716" height="595" usemap="#Map" border="0">
                <div class="city"><div class="citybg" style="background:url(/xmcy/public/home/img/map/anhui.png) no-repeat 0 0; top:314px; left:523px; width:75px; height:90px;"></div><a style=" position:absolute; top:355px; left:545px; z-index:10;" href="<?php echo U('Index/details',array('partner'=>'安徽'));?>">安徽</a></div>
                <div class="city"><div class="citybg" style="background:url(/xmcy/public/home/img/map/neimeng.png) no-repeat 0 0;  top:9px; left:296px; width:318px; height:272px; "></div><a style="position:absolute; top:211px; left:424px; z-index:10;" href="<?php echo U('Index/details',array('partner'=>'内蒙'));?>">内蒙</a></div>
                <div class="city"><div class="citybg" style=" background:url(/xmcy/public/home/img/map/heilongjiang.png) no-repeat 0 0; top:1px; left:550px; width:165px; height:151px;"></div><a style="position:absolute;top:81px; left:624px; z-index:10;" href="<?php echo U('Index/details',array('partner'=>'黑龙江'));?>">黑龙江</a></div>
                <div class="city"><div class="citybg" style=" background:url(/xmcy/public/home/img/map/xinjiang.png) no-repeat 0 0; top:73px; left:0px; width:292px; height:223px;"></div><a style="position:absolute;top:211px; left:124px; z-index:10;" href="<?php echo U('Index/details',array('partner'=>'新疆'));?>">新疆</a></div>
                <div class="city"><div class="citybg" style=" background:url(/xmcy/public/home/img/map/xizang.png) no-repeat 0 0; top:275px; left:31px; width:281px; height:175px;"></div><a style="position:absolute;top:361px; left:145px; z-index:10;" href="<?php echo U('Index/details',array('partner'=>'西藏'));?>">西藏</a></div>
                <div class="city"><div class="citybg" style=" background:url(/xmcy/public/home/img/map/qinghai.png) no-repeat 0 0; top:240px; left:182px; width:185px; height:135px;"></div><a style="position:absolute;top:300px; left:254px; z-index:10;" href="<?php echo U('Index/details',array('partner'=>'青海'));?>">青海</a></div>
                <div class="city"><div class="citybg" style=" background:url(/xmcy/public/home/img/map/gansu.png) no-repeat 0 0; top:187px; left:236px; width:207px; height:177px;"></div><a style="position:absolute;top:310px; left:364px; z-index:10;" href="<?php echo U('Index/details',array('partner'=>'甘肃'));?>">甘肃</a></div>
                <div class="city"><div class="citybg" style=" background:url(/xmcy/public/home/img/map/ningxia.png) no-repeat 0 0; top:245px; left:379px; width:49px; height:75px;"></div><a style="position:absolute;top:272px; left:390px; z-index:10;" href="<?php echo U('Index/details',array('partner'=>'宁夏'));?>">宁夏</a></div>
                <div class="city"><div class="citybg" style=" background:url(/xmcy/public/home/img/map/shanghai.png) no-repeat 0 0; top:354px; left:610px; width:23px; height:22px;"></div><a style="position:absolute;top:352px; left:600px;; z-index:10;" href="<?php echo U('Index/details',array('partner'=>'上海'));?>">上海</a></div>
                <div class="city"><div class="citybg" style=" background:url(/xmcy/public/home/img/map/liaoning.png) no-repeat 0 0; top:161px; left:557px; width:91px; height:87px;"></div><a style="position:absolute;top:180px; left:600px; z-index:10;" href="<?php echo U('Index/details',array('partner'=>'辽宁'));?>">辽宁</a></div>
                <!-- <div class="city"><div class="citybg" style=" background:url(/xmcy/public/home/img/map/guangdong.png) no-repeat 0 0; top:470px; left:464px; width:111px; height:88px;"></div><a style="position:absolute;top:490px; left:500px; z-index:10;" href="index.html">广东</a></div> -->

                <div class="city"><div class="citybg" style=" background:url(/xmcy/public/home/img/map/guangdong.png) no-repeat 0 0; top:470px; left:464px; width:111px; height:88px;"></div><a style="position:absolute;top:485px; left:500px; z-index:10;" href="<?php echo U('Index/details',array('partner'=>'广东'));?>">广东</a></div>    

                <div class="city"><div class="citybg" style=" background:url(/xmcy/public/home/img/map/guangxi.png) no-repeat 0 0; top:454px; left:382px; width:118px; height:92px;"></div><a style="position:absolute;top:488px; left:432px; z-index:10;" href="<?php echo U('Index/details',array('partner'=>'广西'));?>">广西</a></div>
                <div class="city"><div class="citybg" style=" background:url(/xmcy/public/home/img/map/henan.png) no-repeat 0 0; top:288px; left:461px; width:118px; height:92px;"></div><a style="position:absolute;top:320px; left:490px; z-index:10;" href="<?php echo U('Index/details',array('partner'=>'河南'));?>">河南</a></div>
                <div class="city"><div class="citybg" style=" background:url(/xmcy/public/home/img/map/shanxi.png) no-repeat 0 0; top:242px; left:396px; width:79px; height:134px;"></div><a style="position:absolute;top:321px; left:430px; z-index:10;" href="<?php echo U('Index/details',array('partner'=>'陕西'));?>">陕西</a></div>
                <div class="city"><div class="citybg" style=" background:url(/xmcy/public/home/img/map/shanxi2.png) no-repeat 0 0; top:219px; left:458px; width:56px; height:112px;"></div><a style="position:absolute;top:271px; left:470px; z-index:10;" href="<?php echo U('Index/details',array('partner'=>'山西'));?>">山西</a></div>
                <div class="city"><div class="citybg" style=" background:url(/xmcy/public/home/img/map/hebei.png) no-repeat 0 0; top:184px; left:497px; width:85px; height:118px;"></div><a style="position:absolute;top:247px; left:508px; z-index:10;" href="<?php echo U('Index/details',array('partner'=>'河北'));?>">河北</a></div>
                <div class="city"><div class="citybg" style=" background:url(/xmcy/public/home/img/map/jilin.png) no-repeat 0 0; top:113px; left:575px; width:125px; height:88px;"></div><a style="position:absolute;top:150px; left:642px; z-index:10;" href="<?php echo U('Index/details',array('partner'=>'吉林'));?>">吉林</a></div>
                <div class="city"><div class="citybg" style=" background:url(/xmcy/public/home/img/map/beijing.png) no-repeat 0 0; top:210px; left:512px; width:50px; height:38px;"></div><a style="position:absolute;top:215px; left:515px; z-index:10;" href="<?php echo U('Index/details',array('partner'=>'北京'));?>">北京</a></div>
                <div class="city"><div class="citybg" style=" background:url(/xmcy/public/home/img/map/tianjin.png) no-repeat 0 0; top:224px; left:535px; width:26px; height:34px;"></div><a style="position:absolute;top:229px; left:535px; z-index:10;" href="<?php echo U('Index/details',array('partner'=>'天津'));?>">天津</a></div>
                <div class="city"><div class="citybg" style=" background:url(/xmcy/public/home/img/map/shandong.png) no-repeat 0 0; top:256px; left:521px; width:103px; height:68px;"></div><a style="position:absolute;top:281px; left:540px; z-index:10;" href="<?php echo U('Index/details',array('partner'=>'山东'));?>">山东</a></div>
                <div class="city"><div class="citybg" style=" background:url(/xmcy/public/home/img/map/jiangsu.png) no-repeat 0 0; top:305px; left:539px; width:93px; height:72px;"></div><a style="position:absolute;top:321px; left:570px; z-index:10;" href="<?php echo U('Index/details',array('partner'=>'江苏'));?>">江苏</a></div> 
                <div class="city"><div class="citybg" style=" background:url(/xmcy/public/home/img/map/hainan.png) no-repeat 0 0; top:556px; left:442px; width:89px; height:88px;"></div><a style="position:absolute;top:565px; left:450px; z-index:10;" href="<?php echo U('Index/details',array('partner'=>'海南'));?>">海南</a></div>  
                <div class="city"><div class="citybg" style=" background:url(/xmcy/public/home/img/map/hubei.png) no-repeat 0 0; top:345px; left:438px; width:115px; height:75px;"></div><a style="position:absolute;top:365px; left:480px; z-index:10;" href="<?php echo U('Index/details',array('partner'=>'湖北'));?>">湖北</a></div>
                <div class="city"><div class="citybg" style=" background:url(/xmcy/public/home/img/map/yunnan.png) no-repeat 0 0; top:412px; left:280px; width:132px; height:138px;"></div><a style="position:absolute;top:485px; left:320px; z-index:10;" href="<?php echo U('Index/details',array('partner'=>'云南'));?>">云南</a></div>
                <div class="city"><div class="citybg" style=" background:url(/xmcy/public/home/img/map/sichuan.png) no-repeat 0 0; top:328px; left:284px; width:161px; height:143px;"></div><a style="position:absolute;top:385px; left:345px; z-index:10;" href="<?php echo U('Index/details',array('partner'=>'四川'));?>">四川</a></div>
                <div class="city"><div class="citybg" style=" background:url(/xmcy/public/home/img/map/guizhou.png) no-repeat 0 0; top:409px; left:367px; width:93px; height:81px;"></div><a style="position:absolute;top:445px; left:405px; z-index:10;" href="<?php echo U('Index/details',array('partner'=>'贵州'));?>">贵州</a></div> 
                <div class="city"><div class="citybg" style=" background:url(/xmcy/public/home/img/map/taiwan.png) no-repeat 0 0; top:456px; left:613px; width:32px; height:65px;"></div><a style="position:absolute;top:475px; left:613px; z-index:10;" href="<?php echo U('Index/details',array('partner'=>'台湾'));?>">台湾</a></div>
                <div class="city"><div class="citybg" style=" background:url(/xmcy/public/home/img/map/fujian.png) no-repeat 0 0; top:415px; left:548px; width:70px; height:84px;"></div><a style="position:absolute;top:445px; left:565px; z-index:10;" href="<?php echo U('Index/details',array('partner'=>'福建'));?>">福建</a></div>
                <div class="city"><div class="citybg" style=" background:url(/xmcy/public/home/img/map/hunan.png) no-repeat 0 0; top:394px; left:445px; width:83px; height:96px;"></div><a style="position:absolute;top:425px; left:475px; z-index:10;" href="<?php echo U('Index/details',array('partner'=>'湖南'));?>">湖南</a></div>
                <div class="city"><div class="citybg" style=" background:url(/xmcy/public/home/img/map/zhejiang.png) no-repeat 0 0; top:367px; left:574px; width:62px; height:70px;"></div><a style="position:absolute;top:395px; left:588px; z-index:10;" href="<?php echo U('Index/details',array('partner'=>'浙江'));?>">浙江</a></div>
                <div class="city"><div class="citybg" style=" background:url(/xmcy/public/home/img/map/jiangxi.png) no-repeat 0 0; top:390px; left:513px; width:76px; height:98px;"></div><a style="position:absolute;top:425px; left:525px; z-index:10;" href="<?php echo U('Index/details',array('partner'=>'江西'));?>">江西</a></div>
                <div class="city"><div class="citybg" style=" background:url(/xmcy/public/home/img/map/chongqing.png) no-repeat 0 0; top:363px; left:397px; width:70px; height:80px;"></div><a style="position:absolute;top:390px; left:420px; z-index:10;" href="<?php echo U('Index/details',array('partner'=>'重庆'));?>">重庆</a></div>
                <div class="city"><div class="citybg" style=" background:url(/xmcy/public/home/img/map/guangdong.png) no-repeat 0 0; top:470px; left:464px; width:111px; height:88px;"></div><a style="position:absolute;top:510px; left:490px; z-index:10;" href="<?php echo U('Index/details',array('partner'=>'澳门'));?>">澳门</a></div>
                <div class="city"><div class="citybg" style=" background:url(/xmcy/public/home/img/map/guangdong.png) no-repeat 0 0; top:470px; left:464px; width:111px; height:88px;"></div><a style="position:absolute;top:500px; left:520px; z-index:10;" href="<?php echo U('Index/details',array('partner'=>'香港'));?>">香港</a></div>
        </div>
    </section>




    <section class="footer">
        <div class="c-e">
            <img class="img-responsive center-block" src="/xmcy/public/home/img/contact.jpg" alt="">
            <h6>梦淘沙创业家族工作室</h6>
            <p>手机：<?php echo ($config["linktel"]); ?> 丨 微信：<?php echo ($config["linkwx"]); ?> 丨 联系人：<?php echo ($config["linkman"]); ?> 丨 邮箱：<?php echo ($config["linkemail"]); ?> 丨 地址：<?php echo ($config["linkadress"]); ?></p>
            <p><?php echo ($config["beian"]); ?> </p>
        </div>
    </section>




    <script src="/xmcy/public/home/js/jquery.min.js"></script>
    <script src="/xmcy/public/home/js/bootstrap.min.js"></script>
    <script type="text/jscript" src="/xmcy/public/home/js/main.js"></script>




</body>

</html>