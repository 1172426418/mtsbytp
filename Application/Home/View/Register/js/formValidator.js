$(document).ready(function () {

    $("#regForm").bootstrapValidator({
        message: "不能为空",
        //ajax
        submitHandler: function (validator, form, submitButton) {
            //validator: 表单验证实例对象
            //form  jq对象  指定表单对象
            //submitButton  jq对象  指定提交按钮的对象
            // 实用ajax提交表单
            $.post(form.attr('action'), form.serialize(), function (result) {
                // .自定义回调逻辑
            }, 'json');
        },
        /**
         * 表单域配置
         */
        fields: {
            username: {
                validators: {
                    notEmpty: {
                        message: '名字不能为空'
                    },
                    regexp: {
                        regexp: /^[\u4E00-\u9FA5]{2,4}$/,
                        message: '必须是汉字'
                    }
                }
            },
            phone: {
                threshold: 11, //有11字符以上才发送ajax请求，（input中输入一个字符，插件会向服务器发送一次，设置限制，11字符以上才开始）

                validators: {
                    remote: { //ajax验证。server result:{"valid",true or false} 向服务发送当前input name值，获得一个json数据。例表示正确：{"valid",true}  
                        url: 'URlddd', //验证地址
                        message: '该手机号已注册', //提示消息
                        delay: 2000, //每输入一个字符，就发ajax请求，服务器压力还是太大，设置2秒发送一次ajax（默认输入一个字符，提交一次，服务器压力太大）
                        type: 'POST' //请求方式
                        /**自定义提交数据，默认值提交当前input value
                         *  data: function(validator) {
                              return {
                                  password: $('[name="passwordNameAttributeInYourForm"]').val(),
                                  whatever: $('[name="whateverNameAttributeInYourForm"]').val()
                              };
                           }
                         */
                    } ,
                    stringLength: {
                        min: 11,
                        max: 11,
                        message: '用户名长度必须11位'
                    },
                    notEmpty: {
                        message: '手机号不能为空'
                    },
                    regexp: {
                        regexp: /^1[34578]\d{9}$/,
                        message: '请输入正确的手机号'
                    }
                }
            },
            password: {
                validators: {
                    notEmpty: {
                        message: '密码不能为空'
                    },
                    regexp: {
                        regexp: /^[0-9a-zA-Z]{4,16}/,
                        message: '必须是4-16位字母或数字组合'
                    }
                }
            },
            confirmPassword: {
                validators: {
                    notEmpty: {
                        message: '密码不能为空'
                    },
                    identical: {
                        field: 'password',
                        message: '两次密码不一致'
                    }
                }
            },
            verification: {
                validator: {
                    notEmpty: {
                        message: '请输入验证码'
                    }
                }
            }
        }

    });



    var start = true;
    var phStart = true;
    $("#ap").find('input').focus(function () {
        $('.addSpan').remove();
        phStart = true;
        // alert(123);
    });
    
    $(".v-code").click(function () {
        var now = 10;

        var that = this;
        var tel = $("[name=phone]").val();


        //判断是否填了手机号
        if (tel == '' || tel.length < 11 || !/^1[34578]\d{9}$/i.test(tel)) {

            //
            if(phStart){
                var html = '<span class="addSpan">请输入手机号</span>'
                $("#ap").append(html);
            }
            phStart = false;
       


            start = false;
        } else {
            $.ajax({
                url: '',
                type: 'post',
                 
                data: 'phone =' + tel,
                success: function (data) {

                }
            })
        }


        if (start) {

            $(this).css({
                "cursor": "not-allowed",
                "color": "#999"
            });

            start = false;

            nowTime();

        }

        //倒计时
        function nowTime() {
            $(that).html(now + "秒后重新获取验证码");
            now--;
            if (now == 0) {
                clearTimeout(nowTime);
                $(that).html("获取验证码");
                $(that).css({
                    "cursor": "pointer",
                    "color": "#555"
                });
                start = true;
            } else {
                setTimeout(nowTime, 1000);
            }
        }
    })





})