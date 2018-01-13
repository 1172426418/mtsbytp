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



    <link rel="stylesheet" href="/xmcy/public/home/css/case-detail.css">

   <section class="case-content">
        <div class="container">
            <h1 class="clear">
                    <?php echo ($list["title"]); ?>
                <small class="time hidden-xs"><?php echo (date("Y-m-d",$list["addtime"])); ?></small>
            </h1>

            <img class="mrm img-responsive center-block" src="/xmcy/<?php echo ($list["image"]); ?>" alt="">
           
            <div class="content clear">
                <?php echo (htmlspecialchars_decode($list["content"])); ?>
                

            </div>

            <!-- 其他部分 -->
            
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