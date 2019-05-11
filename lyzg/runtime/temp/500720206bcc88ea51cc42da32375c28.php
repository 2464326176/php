<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:92:"D:\aliuyuhang\phpstudy\PHPTutorial\WWW\lyzg\public/../application/index\view\index\home.html";i:1517198312;}*/ ?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8" />
    <meta name="author" content="EdieLei" />
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0;" name="viewport">
    <title>HTML5 图片上传预览</title>
    <style>
        #photo{ width:100px; height:100px; margin:auto; margin-top:100px; background:#0cc; border-radius:100px;}
        #photo img{ width:100px; height:100px; border-radius:50px;}
    </style>
    <script src="HOME_JS/jquery.min.js"></script>

    <script type="text/javascript">
        $(function(){
            $('#img').change(function(){
                var file = this.files[0];
                var r = new FileReader();
                console.log(r);
                r.readAsDataURL(file);
                $(r).load(function(){
                    $('#photo').html('<img src="'+ this.result +'" alt="" />');
                })
            })
        })

    </script>
</head>
<body>
<h3>HTML5 图片上传预览</h3>
<input id="img" type="file" accept="image/*" />
<div id="photo"></div>
</body>
</html>