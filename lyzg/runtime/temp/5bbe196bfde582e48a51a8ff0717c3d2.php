<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:93:"D:\aliuyuhang\phpstudy\PHPTutorial\WWW\lyzg\public/../application/index\view\index\index.html";i:1515828529;}*/ ?>
﻿<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>在线答疑</title>
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<link href="HOME_CSS/style.css" rel="stylesheet" type="text/css">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no, minimal-ui" />
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="format-detection" content="telephone=no, email=no" />
	<link rel="stylesheet" href="HOME_LAY/css/layui.css">
	<style>
		.half {
			margin-top: -3px;
			margin-bottom: 92px;
			width: 100%;
			float: left;
			position: relative;
		}
	</style>
</head>
<body>
<header>
	<img src="HOME_IMG/rpw_back_n.png" onclick="javascript:history.go(-1);location.reload()">
	<span>在线答疑</span>
	<div class="clear"></div>
</header>

<form   action="<?php echo url('index/ajax_form'); ?>"  onsubmit="return CheckForm()" method="post" enctype="multipart/form-data">
	<section class="logo-license">
		<input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
		<div class="half">
			<div class="uploader blue">

				<input type="text" class="filename"  readonly/>
				<a class="license">

					<img id="imageview" src="HOME_IMG/logo_n.png">
				</a>

				<input id="fileupload"  type="file" name="images" size="30"  accept="image/*" capture="camera" />
			</div>
			<div class="yulan">
				<img src="" id="img0" >
				<div class="enter">
					<button type="button" class="btn-2 fl">取消</button>
					<button type="button" class="btn-3 fr">确定</button>
				</div>
			</div>
		</div>
		<div class="clear"></div>
	</section>

	<article class="info">
		<article class="info">
			<ul>
				<li>
					<div class="left">
						填写姓名:
					</div>
					<div class="right">
						<input name="name" id="name" type="text"  placeholder="例:张三李四">
					</div>
					<div class="clear"></div>
				</li>

				<li>
					<div class="left">
						手机号码:
					</div>
					<div class="right">
						<input name="phonenum" id="phonenum" type="text" placeholder="例:138 8888 8888">
					</div>
					<div class="clear"></div>
				</li>
				<li>
					<div class="left">
						学校名称:
					</div>
					<div class="right">
						<input name="schoolname" id="schoolname" type="text"  placeholder="例:成都市锦江区xxxx小学">
					</div>
					<div class="clear"></div>
				</li>
				<li>
					<div class="left">
						所属班级:
					</div>
					<div class="right">
						<input name="classname" id="classname" type="text" placeholder="例:三年级一班">
					</div>
					<div class="clear"></div>
				</li>
				<li>
					<div class="left">
						地区版本:
					</div>
					<div class="right">
						<input name="region" id="region" type="text" placeholder="例:人教版">
					</div>
					<div class="clear"></div>
				</li>
				<li>
					<div class="left">
						所属科目:
					</div>
					<div class="right">
						<input name="subject" id="subject" type="text" placeholder="例:语文">
					</div>
					<div class="clear"></div>
				</li>
				<li>
					<div class="left">
						试题来源:
					</div>
					<div class="right">
						<input name="source" id="source" type="text" placeholder="例:优品金题卷上">
					</div>
					<div class="clear"></div>
				</li>
			</ul>
		</article>
		<article class="btn-1">
			<button href="javascript:;">确认提交</button>
		</article>
</form>




<script src="HOME_LAY/layui.js"></script>

<script src="HOME_JS/jquery.min.js" type="text/javascript"></script>
<script src="HOME_JS/iscroll-zoom.js"></script>
<script src="HOME_JS/hammer.js"></script>
<script src="HOME_JS/jquery.photoClip.js"></script>

<script type="text/javascript">
    $(function() {
        $("#fileupload").change(function() {
            var $file = $(this);
            var objUrl = $file[0].files[0];
            //获得一个http格式的url路径:mozilla(firefox)||webkit or chrome
            var windowURL = window.URL || window.webkitURL;
            //createObjectURL创建一个指向该参数对象(图片)的URL
            var dataURL;
            dataURL = windowURL.createObjectURL(objUrl);
            $("#imageview").attr("src",dataURL);
        });
    });
</script>
<script type="text/javascript">
    function CheckForm() {
        if ($("#fileupload").length==0) {
            alert("请选择上传文件！");
            $("#fileupload").focus();
            return false;
        }
        if ($("#name").val() == "") {
            alert("请填写姓名！");
            $("#name").focus();
            return false;
        }
        if ($("#phonenum").val() == "") {
            alert("请填写联系电话！");
            $("#phonenum").focus();
            return false;
        }

        if ($("#schoolname").val() == "") {
            alert("请填写学校名称！");
            $("#phonenum").focus();
            return false;
        }
        if ($("#classname").val() == "") {
            alert("请填写所属班级！");
            $("#classname").focus();
            return false;
        }
        if ($("#source").val() == "") {
            alert("请填写试题来源！");
            $("#source").focus();
            return false;
        }
    }
</script>



</body>
</html>

