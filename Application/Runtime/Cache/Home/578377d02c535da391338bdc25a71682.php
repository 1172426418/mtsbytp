<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <meta name="keywords" content="名声网,名声,表扬,诚信,信誉,msw110,公正,负责,友善" />
    <meta name="description" content="名声网，平台宗旨：传播好名声，改善差名声，完善社会体系。表扬好名声，改善差名声，人人参与共建诚信社会" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="/xmcy/public/home/img/d-icon.png" type="image/x-icon" />

    <link rel="stylesheet" href="/xmcy/public/home/css/bootstrap.min.css">
    <link rel="stylesheet" href="/xmcy/public/home/css/common.css">
    <link rel="stylesheet" href="/xmcy/public/home/css/index.css">


    <title>名声网</title>
</head>
<script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"16"},"slide":{"type":"slide","bdImg":"2","bdPos":"left","bdTop":"116.5"},"image":{"viewList":["qzone","tsina","tqq","renren","weixin"],"viewText":"分享到：","viewSize":"16"},"selectShare":{"bdContainerClass":null,"bdSelectMiniList":["qzone","tsina","tqq","renren","weixin"]}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
<body>


    <!--  [if lte IE 9]>
        <p class="ie">您的IE浏览器版本太低, 请使用谷歌或非ie内核浏览器浏览, 以获取最佳的体验</p>
    <![endif] -->


    <section id="header">
        <div class="container">
            <div class="header-top clear">
               <a href="" class="logo" title='名声网'> <img class="logo" src="/xmcy/public/home/img/log.png" alt=""></a>

                <span class="head1 hidden-xs">
                    平台宗旨：传播好名声，改善差名声，完善社会诚信体系
                </span>

                <div class="head2">
                    <a href="/">名声网首页</a>
                     <?php if(empty($realname)): ?><a href="<?php echo U('Login/index');?>">登录</a>
                    <?php else: ?><a class="signl" href="javascript:;"><?php echo ($realname); ?>
                        <i></i>
                    </a>
                    <ul>
                        <li>
                            <a href="<?php echo U('User/index');?>">个人中心</a>
                        </li>
                        <li>
                            <a href="<?php echo U('User/ChangePwd');?>">修改密码</a>
                        </li>
                        <li>
                            <a href="<?php echo U('User/Loginout');?>" class="a2">退出登录</a>
                        </li>
                    </ul><?php endif; ?>
                </div>

            </div>
        </div>
    </section>
<!--     <div class="modal fade bs-example-modal-sm" id="tip" tabindex="-1" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
       <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
        <h4 class="modal-title">提示信息</h4>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>

      </div>
    </div>
  </div>
</div> -->
<!-- <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">
        Launch demo modal
      <tton> -->
      
      <!-- Modal -->



    <link rel="stylesheet" href="/xmcy/public/home/css/report-ix-detail.css">

    <section class="report-content">
        <div class="container">
            <h1>
                <?php echo ($result["title"]); ?>
                 <?php if($result['state'] == '0'): ?><span class="active-b">【受理中】</span>
                                <?php elseif($result['state'] == '1'): ?>
                                <span class="active-g">【已通过】</span>
                                <?php else: ?>
                                <span class="active-r">【未通过】</span><?php endif; ?>
            </h1>
            <div class="titel">
                <span class="p1">
                    被举报人：
                    <span><?php echo ($result["bereport"]); ?></span>
                </span>

                <span class="p2">
                    籍贯：
                    <span><?php echo ($result["native_place"]); ?></span>
                </span>
                <span class="p2">
                    手机号：
                    <span><?php echo (substr($result["betel"],0,3)); ?>****<?php echo (substr($result["betel"],-4)); ?></span>
                </span>
                 <?php if($result["becard"] != ''): ?><span class="p2">
                    身份证号：
                    <span><?php echo (substr($result["becard"],0,6)); ?>****<?php echo (substr($result["becard"],-4)); ?></span>
                </span><?php endif; ?>
                <span class="p3">
                    <?php echo (date("Y-m-d",$result["addtime"])); ?>
                </span>

            </div>
            <div class="content clear">
               <p> <?php echo (htmlspecialchars_decode($result["content"])); ?></p>
                <?php if($result['see_tel'] == '1'): ?><span class="p4">
                    手机号：
                    <span><?php echo (get_tel_byid($result["report_id"])); ?></span>
                </span>
                <?php else: ?>
                    <span class="p4">
                    手机号：
                    <span><?php echo (substr_replace(get_tel_byid($result["report_id"]),'****',3,4)); ?></span>
                </span><?php endif; ?>
                <?php if($result['see_qq'] == '1'): ?><span class="p4">
                    Q　 Q：
                    <span><?php echo (get_qq_byid($result["report_id"])); ?></span>
                </span>
                <?php else: ?>
                <span class="p4">
                    Q　 Q：
                    <span><?php echo (substr_replace(get_qq_byid($result["report_id"]),'****',3,4)); ?></span>
                </span><?php endif; ?>
                <?php if($result['see_name'] == '1'): ?><span class="p4">
                    举报人：
                    <span><?php echo (get_user_byid($result["report_id"])); ?></span>
                </span>
                <?php else: ?>
                <span class="p4">
                    举报人：
                    <span><?php echo (substr_replace(get_user_byid($result["report_id"]),' *',3,9)); ?></span>
                </span><?php endif; ?>
            </div>

            <!-- 浏览 -->
            <div class="cont-rex1">
                <div class="title">
                    <i></i>
                    <span>最新浏览人</span>
                </div>
                <div class="rex-ct clear">
                    <?php if(is_array($recent)): foreach($recent as $key=>$vo): ?><div class="man">
                        <span><?php echo (substr_replace(get_user_byid($vo["user_id"]),' *',3,9)); ?></span>
                        <span><?php echo (substr_replace(get_tel_byid($vo["user_id"]),'****',3,4)); ?></span>
                    </div><?php endforeach; endif; ?>
                    
            </div>

            <!-- 评论 -->
            <div class="comt">
                <h1>评论</h1>
                <div class="comt-cont">
                    <h2>热门评论</h2>

                    <!-- 列表 -->
                    <?php if(is_array($list)): foreach($list as $key=>$vo): ?><div class="ct-item">
                        <div class="ct-tit">
                            <i></i>
                            <span><?php echo (substr_replace(get_user_byid($vo["user_id"]),' *',3,9)); ?></span>
                        </div>
                        <div class="cont">
                            <p><?php echo ($vo["content"]); ?></p>
                        </div>
                    </div><?php endforeach; endif; ?>


                    <!-- 列表底部 -->
                    <div class="ct-foo">
                        <?php echo ($page); ?>
                    </div>


                    <!-- item -->
                </div>

                <!-- 文本框 -->
                 <?php if($_SESSION['user_id']!= ''): ?><div class="ct-text">
                    <form action="<?php echo U('Report/Comment');?>" method="post" id="commentform">
                        <textarea name="content" id="content" placeholder="请输入内容"></textarea>
                        <input type="hidden" name="event_id" value="<?php echo ($result["id"]); ?>">
                        <input type="submit" id="g-btn" value="发布">
                    </form>
                </div>
                <?php else: ?>
                <div class="ct-text">
                   请先<a href='/index.php/Login/index.html'> 登录 </a>或<a href='/index.php/Register/index.html'> 注册 </a>后发表评论
                </div><?php endif; ?>

                <!-- comt -->
            </div>

        </div>
    </section>







    <section class="footer hidden-xs">
        <div class="container flex-foo clear">
            <div class="foo1 fmr">
                <dl>
                    <dt>快速链接</dt>
                    <dd>
                        <a href="<?php echo U('Index/Protocol#about');?>">关于我们</a>
                        <a href="">版权政策</a>
                    </dd>
                    <dd>
                        <a href="<?php echo U('Index/Protocol#server');?>">服务协议</a>
                        <a href="">权利通知</a>
                    </dd>
                    <dd>
                        <a href="<?php echo U('Index/Protocol#disclaimer');?>">免责声明</a>
                        <a href="">数据服务</a>
                    </dd>
                    <dd>
                        <a href="">企业名录</a>
                        <a href="">人员名录</a>
                    </dd>
                    <dd>
                        <a href="">品牌名录</a>
                        <a href="">500强</a>
                    </dd>
                    <dd>
                        <a href="">商务通道</a>
                        <a href="">名词解释</a>
                    </dd>
                </dl>
            </div>
            <div class="foo2">
                <dl>
                    <dt>数据来源</dt>
                    <dd>
                        <a target="_blank" href="http://www.gsxt.gov.cn/index.html">全国企业信用信息公示系统</a>
                    </dd>
                    <dd>
                        <a target="_blank" href="http://wenshu.court.gov.cn/">中国裁判文书网</a>
                    </dd>
                    <dd>
                        <a target="_blank" href="http://shixin.court.gov.cn/">中国执行信息公开网</a>
                    </dd>
                    <dd>
                        <a target="_blank" href="http://www.sipo.gov.cn/">国家知识产权局</a>
                    </dd>
                    <dd>
                        <a target="_blank" href="http://sbj.saic.gov.cn/">商标局</a>
                    </dd>
                    <dd>
                        <a target="_blank" href="http://www.ncac.gov.cn/">版权局</a>
                    </dd>
                </dl>
            </div>
            <div class="foo3">
                <dl>
                    <dt>联系我们</dt>
                    <dd>
                        电 话：<?php echo (C("tel")); ?>
                    </dd>
                    <dd>
                        工作时间：<?php echo (C("worktime")); ?>
                    </dd>
                    <dd>
                        在线客服：<?php echo (C("onqq")); ?>
                    </dd>
                    <dd>
                        商务合作：<?php echo (C("email")); ?>
                    </dd>
                </dl>
                <div class="f-btn">
                    <span>
                        <a href="">投诉</a>
                    </span>
                    <span>
                      <!--    <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=2318786390&site=qq&menu=yes">在线咨询</a> -->
                       <a target="_blank" href="">在线咨询</a>
                    </span>
                    <span>
                        <a href="">新浪微博</a>
                    </span>
                </div>

            </div>
            <div class="foo4 fmr">
                <dl>
                    <dt>友情链接</dt>
                    <?php if(is_array($link)): foreach($link as $k=>$vo): if($k%2 == '0'): ?><dd>
                        <a href="<?php echo ($vo["url"]); ?>"><?php echo ($vo["name"]); ?></a>
                    <?php else: ?>
                        <a href="<?php echo ($vo["url"]); ?>"><?php echo ($vo["name"]); ?></a>
                    </dd><?php endif; endforeach; endif; ?>
   
                </dl>
            </div>

            <div class="foo5">
              
                <div class="f-last1">
                    <dl>
                        <dt>微信公众号</dt>
                        <dd>
                            <img src="/xmcy/<?php echo ($qrcode[9]['image']); ?>" alt="">
                        </dd>
                    </dl>
                </div>
           
                <div class="f-last">
                    <dl>
                        <dt>微信公众号</dt>
                        <dd>
                            <img src="/xmcy/<?php echo ($qrcode[10]['image']); ?>" alt="">
                        </dd>
                    </dl>
                </div>

            </div>
        </div>
    </section>
    <div class="foo6 hidden-xs">
        <p>粤ICP备17129180号-1</p>
    </div>

 
    <section class="mb-footer visible-xs-block">
        <div>
            <i class="disc"></i>
            <span>电话：13580897864</span>
        </div>

        <div>
            <i class="disc"></i>
            <span>商务合作：bd@msw110.com</span>
        </div>
    </section>



   
<!--     </script> -->

</body>

</html>

   <script src="/xmcy/public/home/js/jquery.min.js"></script>
    <script src="/xmcy/public/home/js/bootstrap.min.js"></script>

   <script>
        $(function () {
                function tip(msg){
                $(".modal-body").html(msg);
                $('#tip').modal('toggle');
            }
            dropNav(".head2 .signl, .head2 ul",".head2 ul");

            function dropNav(li_ul, dropUl) {
                var $oUl = $(dropUl);
            
                $(li_ul).mouseover(function () {
                    $oUl.stop(true, false).slideDown(100);
                }).mouseout(function () {
                    $oUl.stop(true, false).slideUp(100);
                });
            }
               $(".signl").click(function () {

                if (b) {
                    $ul.stop(true, false).slideDown(100);
                    b = false;
                } else  {
                    $ul.stop(true, false).slideUp(100);
                    b = true;
                }

            })

 

        })
    </script>
<script type="text/javascript">
    $(function(){
        $("#commentform").submit(function(){
           
            var content=$("#content").attr("value");
            if(content==''){
                alert('请输入内容');
                return false;
            }else{
                var datas=$("#commentform").serialize();
                var url=$(this).attr('action');
                $.ajax({
                    type:'post',
                    url:url,
                    data:datas,
                    async:false,
                    dataTpye:'json',
                    success:function(msg){
                        if(msg.code==1){
                            alert(msg.msg);
                            window.location.reload();
                        }else{
                            alert(msg.msg);
                        }
                        
                    }
                })
            }
            
            return false;
        })
    })

</script>