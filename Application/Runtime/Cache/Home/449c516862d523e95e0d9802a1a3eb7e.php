<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <meta name="keywords" content="梦淘沙,创业,创业家族,创新,mengtaosha,梦淘沙创业家族" />
    <meta name="description" content="梦淘沙：让年轻成为你的资本，试着发现生活中的美。调整心态保持品味，用心经营青春无悔。" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge,chrome=1">
    <link rel="icon" href="/xmcy/public/home/img/x-icon.jpg" type="image/x-icon" />
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


    </section>
    <link rel="stylesheet" href="/xmcy/public/home/css/details.css">


    <section class="content">
        <div class="c-e">
            <!-- 搜索 -->
            <form class="search" action="" method="get">


                <div class="input-group">

                    <input type="text" class="form-control" placeholder="全站搜索">

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
   
                    </ul>
                </nav>

                <!-- 导航上 -->
                <nav class="nav-top">
                    <ul>
                        <li>
                            <a href="/xmcy">网站首页</a>
                        </li>
                        <?php if(is_array($top_navigation)): foreach($top_navigation as $key=>$vo): ?><li <?php if($category_id == $vo['category_id']): ?>class="top-active"<?php endif; ?> >
                            <a href="<?php echo U('Index/index',array('category_id'=>$vo['category_id']));?>"><?php echo ($vo["category_name"]); ?></a>
                            </li><?php endforeach; endif; ?>

                        <li class="top-active">
                            <a href="<?php echo U('Index/linkus');?>">联系我们</a>
                        </li>
                    </ul>
                </nav>

                <!-- 内容区 -->
                <article class="cont-box">
                    <!-- 内容 -->
                    <div class="news">
                        <h3><?php echo ($result["title"]); ?></h3>

                        <div class="contents"><?php echo (htmlspecialchars_decode($result["content"])); ?></div>
                    </div>

                </article>


            </article>


        </div>
    </section>

   




    <section class="footer">
        <div class="c-e">
            <img class="img-responsive center-block" src="/xmcy/public/home/img/contact.jpg" alt="">
            <h6>梦淘沙创业家族工作室</h6>
            <p>手机：<?php echo ($config["linktel"]); ?> 丨 微信：<?php echo ($config["linkwx"]); ?> 丨 联系人：<?php echo ($config["linkman"]); ?> 丨 邮箱：<?php echo ($config["linkemail"]); ?> 丨 地址：<?php echo ($config["linkadress"]); ?></p>
        </div>
    </section>




    <script src="/xmcy/public/home/js/jquery.min.js"></script>
    <script src="/xmcy/public/home/js/bootstrap.min.js"></script>
    <script type="text/jscript" src="/xmcy/public/home/js/main.js"></script>




</body>

</html>