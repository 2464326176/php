<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:93:"D:\aliuyuhang\phpstudy\PHPTutorial\WWW\lyzg\public/../application/admin\view\index\index.html";i:1514180261;s:83:"D:\aliuyuhang\phpstudy\PHPTutorial\WWW\lyzg\application\admin\view\public\left.html";i:1515828010;s:85:"D:\aliuyuhang\phpstudy\PHPTutorial\WWW\lyzg\application\admin\view\public\header.html";i:1516937255;s:85:"D:\aliuyuhang\phpstudy\PHPTutorial\WWW\lyzg\application\admin\view\public\footer.html";i:1513213374;s:83:"D:\aliuyuhang\phpstudy\PHPTutorial\WWW\lyzg\application\admin\view\public\tool.html";i:1513213374;}*/ ?>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">

    <title>主页面</title>
    <link href="ADMIN_CSS/bootstrap.min.css?v=3.4.0" rel="stylesheet">
    <link href="ADMIN_FONTS/font-awesome.css" rel="stylesheet">

    <link href="ADMIN_CSS/animate.css" rel="stylesheet">
    <link href="ADMIN_CSS/style.css?v=2.2.0" rel="stylesheet">

</head>

<body class="pace-done">
    <div class="pace  pace-inactive">
        <div class="pace-progress" data-progress-text="100%" data-progress="99" style="width: 100%;">
            <div class="pace-progress-inner"></div>
        </div>
        <div class="pace-activity"></div>
    </div>
    <div id="wrapper">
        <!-- 侧栏 -->
        <nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="side-menu">
            <li class="nav-header">

                <div class="dropdown profile-element"> <span>
                            <img alt="image" class="img-circle" src="ADMIN_IMG/profile_small.jpg">
                             </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="index.html#">
                        <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?php echo session('nickname') ?></strong>
                             </span> <span class="text-muted text-xs block"><?php echo session('groupname') ?><b class="caret"></b></span> </span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <!-- <li><a href="form_avatar.html">修改头像</a>
                        </li>
                        <li><a href="profile.html">个人资料</a>
                        </li>
                        <li><a href="contacts.html">联系我们</a>
                        </li>
                        <li><a href="mailbox.html">信箱</a>
                        </li>
                        <li class="divider"></li> -->
                        <li><a href="<?php echo url('Login/logout'); ?>">安全退出</a>
                        </li>
                    </ul>
                </div>
                <div class="logo-element">
                    AD
                </div>

            </li>
            <li>
                <a href="#"><i class="fa fa-windows"></i> <span class="nav-label">网站系统管理</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="<?php echo url('Admin/index'); ?>">管理员管理</a>
                    </li>

                    <!-- <li><a href="<?php echo url('About/index'); ?>">关于我们</a>
                    </li>
                    <li><a href="<?php echo url('Contact/index'); ?>">联系我们</a>
                    </li> -->
                </ul>
            </li>

            <li>
                <a href="#"><i class="fa fa-indent"></i> <span class="nav-label">在线答疑</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">

                    <li><a href="<?php echo url('consult/index'); ?>">查看回复</a>
                    </li>


                </ul>
            </li>







        </ul>

    </div>
</nav>
        <!-- 侧栏 -->
        <div id="page-wrapper" class="gray-bg dashbard-1">
            <!-- 头部 -->
            <div class="row border-bottom">
    <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary "><i class="fa fa-bars"></i> </a>
            <form role="search" class="navbar-form-custom" method="post" action="search_results.html">
                <div class="form-group">
                    <input type="text" placeholder="" class="form-control" name="top-search" id="top-search">
                </div>
            </form>
        </div>
        <ul class="nav navbar-top-links navbar-right">
            <li>
                <span class="m-r-sm text-muted welcome-message"><a href="<?php echo url('Index/index'); ?>" title="返回首页"><i class="fa fa-home"></i></a>欢迎使用！</span>
            </li>
            <!--   <li class="dropdown">
                            <a class="dropdown-toggle count-info" data-toggle="dropdown" href="1.html#">
                                <i class="fa fa-envelope"></i>  <span class="label label-warning">16</span>
                            </a>
                            <ul class="dropdown-menu dropdown-messages">
                                <li>
                                    <div class="dropdown-messages-box">
                                        <a href="profile.html" class="pull-left">
                                            <img alt="image" class="img-circle" src="img/a7.jpg">
                                        </a>
                                        <div class="media-body">
                                            <small class="pull-right">46小时前</small>
                                            <strong>小四</strong> 项目已处理完结
                                            <br>
                                            <small class="text-muted">3天前 2014.11.8</small>
                                        </div>
                                    </div>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <div class="dropdown-messages-box">
                                        <a href="profile.html" class="pull-left">
                                            <img alt="image" class="img-circle" src="img/a4.jpg">
                                        </a>
                                        <div class="media-body ">
                                            <small class="pull-right text-navy">25小时前</small>
                                            <strong>国民岳父</strong> 这是一条测试信息
                                            <br>
                                            <small class="text-muted">昨天</small>
                                        </div>
                                    </div>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <div class="text-center link-block">
                                        <a href="mailbox.html">
                                            <i class="fa fa-envelope"></i>  <strong> 查看所有消息</strong>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a class="dropdown-toggle count-info" data-toggle="dropdown" href="1.html#">
                                <i class="fa fa-bell"></i>  <span class="label label-primary">8</span>
                            </a>
                            <ul class="dropdown-menu dropdown-alerts">
                                <li>
                                    <a href="mailbox.html">
                                        <div>
                                            <i class="fa fa-envelope fa-fw"></i> 您有16条未读消息
                                            <span class="pull-right text-muted small">4分钟前</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a href="profile.html">
                                        <div>
                                            <i class="fa fa-qq fa-fw"></i> 3条新回复
                                            <span class="pull-right text-muted small">12分钟钱</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <div class="text-center link-block">
                                        <a href="notifications.html">
                                            <strong>查看所有 </strong>
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </li> -->


            <li>
                <a href="<?php echo url('Login/logout'); ?>">
                    <i class="fa fa-sign-out"></i> 退出
                </a>
            </li>
        </ul>

    </nav>
</div>
            <!-- 头部 -->
            <!-- 面包导航 -->
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-sm-4">
                    <h2>当前位置</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="index.html">主页</a>
                        </li>
                        <li>
                            <strong>包屑导航</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-sm-8">
                    <div class="title-action">
                        <a href="" class="btn btn-primary">活动区域</a>
                    </div>
                </div>
            </div>

            <!-- 主页面 -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="wrapper wrapper-content">
                        <div class="middle-box text-center animated fadeInRightBig">
                            <h3 class="font-bold">这里是页面内容</h3>

                            <div class="error-desc">
                                您可以在这里添加栅格，参考首页及其他页面完成不同的布局
                                <br><a href="index.html" class="btn btn-primary m-t">打开主页</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 主页面 -->

            <!-- 尾部 -->
            <div class="footer">
    <div class="pull-right">

    </div>
    <div>
        题库<strong>Copyright</strong> © 2017
    </div>
</div>

        </div>
    </div>


    <!-- Mainly scripts -->
    <script src="ADMIN_JS/jquery-3.2.1.min.js"></script>
    <script src="ADMIN_JS/bootstrap.min.js?v=3.4.0"></script>
    <script src="ADMIN_JS/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="ADMIN_JS/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="ADMIN_JS/hplus.js?v=2.2.0"></script>
    <script src="ADMIN_JS/plugins/pace/pace.min.js"></script>




    <!-- 尾部 -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<div class="theme-config">
    <div class="theme-config-box">
        <div class="spin-icon">
            <i class="fa fa-cog fa-spin"></i>
        </div>
        <div class="skin-setttings">
            <div class="title">主题设置</div>
            <div class="setings-item">
                <span>
                        收起左侧菜单
                    </span>

                <div class="switch">
                    <div class="onoffswitch">
                        <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="collapsemenu">
                        <label class="onoffswitch-label" for="collapsemenu">
                            <span class="onoffswitch-inner"></span>
                            <span class="onoffswitch-switch"></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="setings-item">
                <span>
                        固定侧边栏
                    </span>

                <div class="switch">
                    <div class="onoffswitch">
                        <input type="checkbox" name="fixedsidebar" class="onoffswitch-checkbox" id="fixedsidebar">
                        <label class="onoffswitch-label" for="fixedsidebar">
                            <span class="onoffswitch-inner"></span>
                            <span class="onoffswitch-switch"></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="setings-item">
                <span>
                        固定顶部
                    </span>

                <div class="switch">
                    <div class="onoffswitch">
                        <input type="checkbox" name="fixednavbar" class="onoffswitch-checkbox" id="fixednavbar">
                        <label class="onoffswitch-label" for="fixednavbar">
                            <span class="onoffswitch-inner"></span>
                            <span class="onoffswitch-switch"></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="setings-item">
                <span>
                        固定宽度
                    </span>

                <div class="switch">
                    <div class="onoffswitch">
                        <input type="checkbox" name="boxedlayout" class="onoffswitch-checkbox" id="boxedlayout">
                        <label class="onoffswitch-label" for="boxedlayout">
                            <span class="onoffswitch-inner"></span>
                            <span class="onoffswitch-switch"></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="setings-item">
                <span>
                        固定底部
                    </span>

                <div class="switch">
                    <div class="onoffswitch">
                        <input type="checkbox" name="fixedfooter" class="onoffswitch-checkbox" id="fixedfooter">
                        <label class="onoffswitch-label" for="fixedfooter">
                            <span class="onoffswitch-inner"></span>
                            <span class="onoffswitch-switch"></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="setings-item">
                <span>
                        RTL模式
                    </span>

                <div class="switch">
                    <div class="onoffswitch">
                        <input type="checkbox" name="RTLmode" class="onoffswitch-checkbox" id="RTLmode">
                        <label class="onoffswitch-label" for="RTLmode">
                            <span class="onoffswitch-inner"></span>
                            <span class="onoffswitch-switch"></span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="title">皮肤选择</div>
            <div class="setings-item default-skin">
                <span class="skin-name ">
                         <a href="#" class="s-skin-0">
                             默认皮肤
                         </a>
                    </span>
            </div>
            <div class="setings-item blue-skin">
                <span class="skin-name ">
                        <a href="#" class="s-skin-1">
                            蓝色主题
                        </a>
                    </span>
            </div>
            <div class="setings-item yellow-skin">
                <span class="skin-name ">
                        <a href="#" class="s-skin-3">
                            黄色/紫色主题
                        </a>
                    </span>
            </div>
            <div class="setings-item ultra-skin">
                <span class="skin-name ">
                        <a href="#" class="s-skin-2">
                            灰色主题
                        </a>
                    </span>
            </div>
        </div>
    </div>
</div>
<script>
    // 顶部菜单固定
    $('#fixednavbar').click(function() {
        if ($('#fixednavbar').is(':checked')) {
            $(".navbar-static-top").removeClass('navbar-static-top').addClass('navbar-fixed-top');
            $("body").removeClass('boxed-layout');
            $("body").addClass('fixed-nav');
            $('#boxedlayout').prop('checked', false);
        } else {
            $(".navbar-fixed-top").removeClass('navbar-fixed-top').addClass('navbar-static-top');
            $("body").removeClass('fixed-nav');
        }
    });

    // 左侧菜单固定
    $('#fixedsidebar').click(function() {
        if ($('#fixedsidebar').is(':checked')) {
            $("body").addClass('fixed-sidebar');
            $('.sidebar-collapse').slimScroll({
                height: '100%',
                railOpacity: 0.9
            });
        } else {
            $('.sidebar-collapse').slimscroll({
                destroy: true
            });
            $('.sidebar-collapse').attr('style', '');
            $("body").removeClass('fixed-sidebar');
        }
    });

    // 收起左侧菜单
    $('#collapsemenu').click(function() {
        if ($('#collapsemenu').is(':checked')) {
            $("body").addClass('mini-navbar');
            SmoothlyMenu();
        } else {
            $("body").removeClass('mini-navbar');
            SmoothlyMenu();
        }
    });

    // 自适应宽度
    $('#boxedlayout').click(function() {
        if ($('#boxedlayout').is(':checked')) {
            $("body").addClass('boxed-layout');
            $('#fixednavbar').prop('checked', false);
            $(".navbar-fixed-top").removeClass('navbar-fixed-top').addClass('navbar-static-top');
            $("body").removeClass('fixed-nav');
            $(".footer").removeClass('fixed');
            $('#fixedfooter').prop('checked', false);
        } else {
            $("body").removeClass('boxed-layout');
        }
    });

    // 底部版权固定
    $('#fixedfooter').click(function() {
        if ($('#fixedfooter').is(':checked')) {
            $('#boxedlayout').prop('checked', false);
            $("body").removeClass('boxed-layout');
            $(".footer").addClass('fixed');
        } else {
            $(".footer").removeClass('fixed');
        }
    });

    // RTL模式
    $('#RTLmode').click(function() {
        if ($('#RTLmode').is(':checked')) {
            $('head').append('<link href="css/bootstrap-rtl.css" id="rtl-mode" rel="stylesheet">');
            $('body').addClass('rtls');
        } else {
            $('#rtl-mode').remove();
            $('body').removeClass('rtls');
        }
    });

    // 皮肤选择
    $('.spin-icon').click(function() {
        $(".theme-config-box").toggleClass("show");
    });

    // 默认主题
    $('.s-skin-0').click(function() {
        $("body").removeClass("skin-1");
        $("body").removeClass("skin-2");
        $("body").removeClass("skin-3");
    });

    // 蓝色主题
    $('.s-skin-1').click(function() {
        $("body").removeClass("skin-2");
        $("body").removeClass("skin-3");
        $("body").addClass("skin-1");
    });

    // 灰色主题
    $('.s-skin-2').click(function() {
        $("body").removeClass("skin-1");
        $("body").removeClass("skin-3");
        $("body").addClass("skin-2");
    });

    // 黄色主题
    $('.s-skin-3').click(function() {
        $("body").removeClass("skin-1");
        $("body").removeClass("skin-2");
        $("body").addClass("skin-3");
    });
</script>

<style>
    .fixed-nav .slimScrollDiv #side-menu {
        padding-bottom: 60px;
    }
</style>
    <!-- 尾部 -->



</body>

</html>