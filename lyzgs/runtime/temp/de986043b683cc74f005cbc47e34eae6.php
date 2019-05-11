<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:93:"D:\aliuyuhang\phpstudy\PHPTutorial\WWW\lyzg\public/../application/admin\view\login\index.html";i:1516968902;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>站点后台登录</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="HOME_LAY/css/layui.css"  media="all">
    <meta name="author" content="DeathGhost" />
    <link rel="stylesheet" type="text/css" href="ADMIN_LOG/css/style.css" tppabs="ADMIN_LOG/css/style.css" />
    <style>
        body{height:100%;background:#16a085;overflow:hidden;}
        canvas{z-index:-1;position:absolute;}
    </style>

</head>
<body>
<dl class="admin_login">
    <dt>
        <strong>站点后台管理系统</strong>
        <em>Management System</em>
    </dt>

    <form method="post" action="" onsubmit="return checkform()">
    <dd class="user_icon">
        <input type="text" placeholder="账号" name="username" id="username"  class="login_txtbx"/>
    </dd>
    <dd class="pwd_icon">
        <input type="password" placeholder="密码" id="password" name="password" class="login_txtbx"/>
    </dd>
    <dd class="val_icon">
        <div class="checkcode">
            <input type="text" id="J_codetext" name="J_codetext"  placeholder="验证码" maxlength="4" class="login_txtbx">


            <canvas class="J_codeimg" id="myCanvas" onclick="createCode()"></canvas>
        </div>
        <input type="button" value="刷新验证码" class="ver_btn" onclick="validateCode()">
    </dd>
    <dd>
        <input type="button" id="submit" value="立即登陆" class="submit_btn"/>
    </dd>
    </form>



</dl>
<script src="ADMIN_LOG/js/jquery.js"></script>
<script src="ADMIN_LOG/js/verificationNumbers.js" tppabs="ADMIN_LOG/js/verificationNumbers.js"></script>
<script src="ADMIN_LOG/js/Particleground.js" tppabs="ADMIN_LOG/js/Particleground.js"></script>
<script src="HOME_LAY/layui.js" charset="utf-8"></script>
<script>
    $(document).ready(function() {
        //粒子背景特效
        $('body').particleground({
            dotColor: '#5cbdaa',
            lineColor: '#5cbdaa'
        });
        //模拟一次验证码
        createCode();
    });
</script>
<script>
    $('#submit').click(function() {
        if(validateCode()!=false){
            var prompt_ =0;
                if ($("#username").val() == "") {
                    $("#username").attr({"placeholder":"账号不能为空！"}).focus();
                    prompt_+=1;
                }
                if ($("#password").val() == "") {
                    $("#password").attr({"placeholder":"密码不能为空！"}).focus();
                    prompt_+=1;
                }
            if (prompt_ ==0) {
                layui.use('layer', function () {
                    var $ = layui.jquery, layer = layui.layer;
                $.post("<?php echo url('login/index'); ?>", {
                    username: $('#username').val(),
                    password: $('#password').val()
                }, function (res) {
                    if(res==1){
                        layer.msg('用户不存在！');
                    }
                    if(res==2){
                        layer.msg('登录成功！');
                        window.location.href="<?php echo url('index/index'); ?>";
                    }
                    if(res==3){
                        layer.msg('密码错误！');
                    }
                    if(res==4){
                        layer.msg('本账号受到限制,无权登录后台！');
                    }
                    if(res==5){
                        layer.msg('管理员状态未审核 请联系超级管理员！');
                    }
                })
                });
            }
        }
    })

</script>
</body>
</html>
