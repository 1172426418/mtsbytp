<?php
return array(
    /* 默认设定 */
    'DEFAULT_MODULE'        =>  'Admin',  // 默认模块
    'DEFAULT_CONTROLLER'    =>  'Index', // 默认控制器名称
    'DEFAULT_ACTION'        =>  'index', // 默认操作名称

    /* 数据库设置 */
    'DB_TYPE'               =>  'mysqli',     // 数据库类型
    'DB_HOST'               =>  'localhost', // 服务器地址
    'DB_NAME'               =>  'mts',          // 数据库名
    'DB_PREFIX'             => 'ms_',
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  '',          // 密码
    'DB_PORT'               =>  '3306',        // 端口
    'DB_FIELDS_CACHE'       =>  false,        // 启用字段缓存
        //中英文切换语言包配置项
    'LANG_SWITCH_ON'     =>     true,    //开启语言包功能        
    'LANG_AUTO_DETECT'     =>     true, // 自动侦测语言
    'DEFAULT_LANG'         =>     'zh-cn', // 默认语言        
    'LANG_LIST'            =>    'zh-cn,en-us', //必须写可允许的语言列表
    'VAR_LANGUAGE'     => 'l', // 默认语言切换变量
    /* 模板引擎设置 */
    'TMPL_CONTENT_TYPE'     =>  'text/html', // 默认模板输出类型
    'TMPL_ACTION_ERROR'     =>  'Public/home/html/jump.tpl', // 默认错误跳转对应的模板文件
    'TMPL_ACTION_SUCCESS'   =>  'Public/home/html/jump.tpl', // 默认成功跳转对应的模板文件
    'TMPL_EXCEPTION_FILE'   =>  THINK_PATH.'Tpl/think_exception.tpl',// 异常页面的模板文件.


    /* URL设置 */
    'URL_CASE_INSENSITIVE'  =>  true,   // 默认false 表示URL区分大小写 true则表示不区分大小写
    'URL_MODEL'             =>  1,       // URL访问模式,可选参数0、1、2、3,代表以下四种模式：
    // 0 (普通模式); 1 (PATHINFO 模式); 2 (REWRITE  模式); 3 (兼容模式)  默认为PATHINFO 模式
    //  "WEIXIN_PAY_OFF"=>'2',
    // 'LOAD_EXT_CONFIG'=>"myconfig",//加载自定义配置文件
    "ALIPAY_CONFIG"=>array(
        //应用ID,您的APPID。
        'app_id' => "2017122101032062",

        //商户私钥
        'merchant_private_key' => "MIIEpAIBAAKCAQEAqHRP5m4IK+LvONxThgGO89RUTdJ6j91XIsRnUNLsyhS2KbhH30u+iRBP0rkzslN5ZR6QPH709yZNlpRSbtTLb43bB+vZOvHvzf5mxwQ37bOXEMxQiBLdZOKmf0NYC/Rhwxq7BRldP69Yy6tre/D9MF3WoNcdCxAp+dpQw/JecIKI0LdeOaBz6VRdyRKCJfI4yaClMnB4Gdoqrf53ozH61JehLzjve1NncB+hqgnDXyizCjB51n8urzykjNK/qsR6eiH7SyWgrfZ87rGx4SM1gJZZdM5TuxN32GhUHVyBJUa1vgFXrXDJnnkL1Vb0yELu1faNrcHutjb/ssSw/YvaewIDAQABAoIBAEoE2br57FNEYzNL9NN0SdkwGl8btkkSzB/1xyQHmo5tLWIFnGcsxCs75KdGQ8X+0d+x31UFwCP9S6h3wgT7MezxmyXO52P0PRf5yjV20BB9kkqKTHSOPYP/54MSF1Uha/er/jOOYqACL3VG/HK4gLhI8283NobO8nLcEBMZo4+xxPxlDhJwp9AcovE5A1Hu98/bWtlJwKb6STpuZcDZI0o9uZvSwNvLSvFfkvQl+dLMKbLIsGpBmXWhHv5k+p8rZmB4ZK0YHnnE1wA1/KkZwYSKRBHp5iRP99Q8Y4wttROVfuYbxT0hNnc56drHMEnI00S3JEvbT2QHNi/VPrSQNwECgYEA3imTL2zyCtyCQoLEf4zTDd53tvwRWgN/d/TSYoW6wZQ5veZucdW+0jSwY1WwVtYlcFnZ21P5YJ4zkFVkSh6bPNuPMPk+GJBLy48kF/yUmFPU1UKTX76w0XwnH2tnvgC8clsOMU69ZHE0cJjq5hUVWpXGNawM7tGlQ/hAmCXO34ECgYEAwhyVlgYO/vYKgMegETRe9E9dSQZn2Q0pq0ImWM8RQZh5O/bZr7NSnSx6LxX/LMC3aH9nxlYyq4A7pchcxK7t0PpoQFGqjShL0qN0IgofKm5tSfLUEhyQxNnCWaCVSIyybFGZjiRBTpM0Qd6UsTJz1/7GIM9QbUm0DhMU1hKyN/sCgYAx+9air/dRHEWuYy+EpxGBKFF0+QeKYgkW2x1Oj1nyXcAUCrlEoVuafcJFxyyyjOHFgmGyqBUOeOmPCrdSucohiiCQWzNuYWC8PstXHjvsfcf/50ezHfs4Vp+SwR6JMC8152itDVMtOw8aWj1XYNz6EYKT5s7OGJr/TOZzlOYTgQKBgQC/niYQdiShjdKqc+XQdglyVVI6P0eOnY7Pz7o5Gxfm0BSFnFYiOvxHydtH1ggTbp7fWj3gLcFRSYIYUqU5R5HeJQN60uNw+yF2awK+g41mfqIGSN8OjgJfQLO5dGtJthKAGUFjbujFH02L5KSWE78Fryx4wQ6dBA/pgO6lsMkbtwKBgQC1YmhsNfUKBt0h9ZZAKMvg44DcerVlRKha2eoAt/Xz97NINecLFgjSi9eAS/vFT80mFVr5EOfsmHu1+hWN6y3lkYQItDwv9X5pMj39LtFyBmbMlSsqQaTjx36wyYfruLlGF1yTA7uFgeDxfepu0fFtOo4F9CPU4DCZXr3ZkKaySw==",
        
        //异步通知地址
        'notify_url' => "http://1.msw110.com/index.php/AliPay/notify",
        
        //同步跳转
        'return_url' => "http://1.msw110.com/index.php/User/index",

        //编码格式
        'charset' => "utf-8",

        //签名方式
        'sign_type'=>"RSA",

        //支付宝网关
        'gatewayUrl' => "https://openapi.alipay.com/gateway.do",

        //支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
        'alipay_public_key' => "MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDDI6d306Q8fIfCOaTXyiUeJHkrIvYISRcc73s3vF1ZT7XN8RNPwJxo8pWaJMmvyTn9N4HQ632qJBVHf8sxHi/fEsraprwCtzvzQETrNRwVxLO5jVmRGi60j8Ue1efIlzPXV9je9mkjzOmdssymZkh2QhUrCmZYI/FCEa3/cNMW0QIDAQAB",
    ),
    'WEIXINPAY_CONFIG'       => array(
        'APPID'              => 'wx8f83badcf17678c0', // 微信支付APPID
        'MCHID'              => '1456560702', // 微信支付MCHID 商户收款账号
        'KEY'                => 'wuhanxuanmingwangluo20171124csmy', // 微信支付KEY
        'APPSECRET'          => '9c1f64d4d3fb0b4b246414c3194de9b0', // 公众帐号secert (公众号支付专用)
        'NOTIFY_URL'         => 'http://1.msw110.com/index.php/WeixinPay/notify', // 接收支付状态的连接
        ),
    // 配置邮件发送服务器
    'MAIL_HOST' =>'smtp.exmail.qq.com',//smtp服务器的名称smtp.exmail.qq.com
    'MAIL_SMTPAUTH' =>TRUE, //启用smtp认证renxiaole66@126.com
    'MAIL_USERNAME' =>'bd@msw110.com',//你的邮箱名mingshengwang110@163.com  
    'MAIL_FROM' =>'bd@msw110.com',//发件人地址mingshengwang110@163.com  
    'MAIL_FROMNAME'=>'名声网',//发件人姓名名声网
    'MAIL_PASSWORD' =>'Msw110',//邮箱授权密码whxmcy2017
    'MAIL_CHARSET' =>'utf-8',//设置邮件编码
    'MAIL_ISHTML' =>TRUE, // 是否HTML格式邮件

);
