<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:97:"D:\aliuyuhang\phpstudy\PHPTutorial\WWW\lyzg\public/../application/admin\view\testpaper\index.html";i:1518059472;s:83:"D:\aliuyuhang\phpstudy\PHPTutorial\WWW\lyzg\application\admin\view\public\left.html";i:1518059472;s:85:"D:\aliuyuhang\phpstudy\PHPTutorial\WWW\lyzg\application\admin\view\public\header.html";i:1518059472;s:85:"D:\aliuyuhang\phpstudy\PHPTutorial\WWW\lyzg\application\admin\view\public\footer.html";i:1518059472;s:83:"D:\aliuyuhang\phpstudy\PHPTutorial\WWW\lyzg\application\admin\view\public\tool.html";i:1518059472;}*/ ?>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <title>试卷审核</title>
    <link href="HOME_CSS/base.css" rel="stylesheet" type="text/css" />
    <link href="ADMIN_CSS/bootstrap.min.css?v=3.4.0" rel="stylesheet">
    <link href="ADMIN_FONTS/font-awesome.css" rel="stylesheet">

    <link href="ADMIN_CSS/animate.css" rel="stylesheet">
    <link href="ADMIN_CSS/style.css?v=2.2.0" rel="stylesheet">
    <link rel="stylesheet" href="HOME_LAY/css/layui.css">
    <!-- Data Tables -->
    <link href="ADMIN_CSS/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <style>
    </style>
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
                <a href="#"><i class="fa fa-code"></i> <span class="nav-label">小程序管理</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="<?php echo url('smallprogram/index'); ?>">基本信息</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-cog"></i> <span class="nav-label">微信公众号管理</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">

                    <li><a href="<?php echo url('wxchat/index'); ?>">基本信息</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-indent"></i> <span class="nav-label">在线答疑管理</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">

                    <li><a href="<?php echo url('consult/index'); ?>">查看回复</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-clipboard"></i> <span class="nav-label">试卷管理</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">

                    <li><a href="<?php echo url('testpaper/index'); ?>">试卷查看</a>
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
                    <a href="" onclick="window.location.reload();" class="btn btn-primary">刷新页面</a>
                </div>
            </div>
        </div>

        <!-- 主页面 -->
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>基本 <small>分类，查找</small></h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="table_data_tables.html#">
                                <i class="fa fa-wrench"></i>
                            </a>

                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">


                        <table class="table table-striped table-bordered table-hover dataTables-example dataTable" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info">


                            <thead>
                            <tr role="row">
                                <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" >ID</th>
                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" >微信昵称</th>
                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">名字</th>
                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">性别</th>
                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">电话</th>
                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">地址</th>
                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">科目</th>
                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">版本</th>
                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">年级</th>
                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">试卷</th>

                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">提交时间</th>
                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">操作</th>
                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">状态</th>
                            </tr>
                            </thead>
                            <tbody>


                            <?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): if( count($data)==0 ) : echo "" ;else: foreach($data as $key=>$vo): ?>
                            <form  action="<?php echo url('consult/ajax_form'); ?>"  onsubmit="return CheckForm()" method="post" enctype="multipart/form-data">

                                <tr>
                                    <td><a href="<?php echo url('reply/reply'); ?>"><?php echo $vo['id']; ?></a></td>
                                    <td><?php echo $vo['nickname']; ?></td>
                                    <td><?php echo $vo['name']; ?></td>
                                    <td><?php if($vo['sex'] == '1'): ?>男<?php endif; if($vo['sex'] == '2'): ?>女<?php endif; if($vo['sex'] == '0'): ?>未知<?php endif; ?></td>
                                    <td><?php echo $vo['phonenum']; ?></td>
                                    <td><?php echo $vo['address']; ?></td>
                                    <td><?php echo $vo['stage']; ?></td>
                                    <td><?php echo $vo['edition']; ?></td>
                                    <td><?php echo $vo['grade']; ?></td>
                                    <td>
                                        <div id="picurl" class="layer-photos-demo">
                                            <img layer-pid="" layer-src="<?php echo $vo['picurl']; ?>" src="<?php echo $vo['picurl']; ?>" style="height: 40px;width: 40px;" alt="试卷">
                                        </div>

                                    </td>

                                    <td><?php echo date('Y-m-d H:i:s',$vo['time']); ?></td>
                                    <td>
                                        <div class="layui-upload">
                                            <button type="button" class="btn btn-success" data-id="<?php echo $vo['id']; ?>" value="<?php echo $vo['user_id']; ?>"><i class="fa fa-send"></i>&nbsp;&nbsp;
                                                <span class="bold">发送消息</span>
                                            </button>
                                        </div>

                                    </td>
                                    <td>
                                        <?php if($vo['state'] == '已处理'): ?>
                                        <button type="button" class="btn btn-info">
                                            <i class="fa fa-check"></i>&nbsp;&nbsp;
                                            <span class="bold"><?php echo $vo['state']; ?></span>
                                        </button>
                                        <?php else: ?>
                                        <button type="button" class="btn btn-danger" >
                                            <i class="fa fa-times"></i>&nbsp;&nbsp;
                                            <span class="bold"><?php echo $vo['state']; ?></span>
                                        </button>
                                        <?php endif; ?>

                                    </td>

                                </tr>

                            </form>
                            <?php endforeach; endif; else: echo "" ;endif; ?>


                            </tbody>


                        </table>



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

<script src="HOME_LAY/layui.js"></script>
<script type="text/javascript" src="HOME_JS/jquery.jqzoom.js"></script>


<script src="ADMIN_JS/plugins/jeditable/jquery.jeditable.js"></script>

<!-- Data Tables -->
<script src="ADMIN_JS/plugins/dataTables/jquery.dataTables.js"></script>
<script src="ADMIN_JS/plugins/dataTables/dataTables.bootstrap.js"></script>

<script type="text/javascript">

    $(function(){
        var MobileUA = (function() {
            var ua = navigator.userAgent.toLowerCase();
            var mua = {
                IOS: /ipod|iphone|ipad/.test(ua), //iOS
                IPHONE: /iphone/.test(ua), //iPhone
                IPAD: /ipad/.test(ua), //iPad
                ANDROID: /android/.test(ua), //Android Device
                WINDOWS: /windows/.test(ua), //Windows Device
                TOUCH_DEVICE: ('ontouchstart' in window) || /touch/.test(ua), //Touch Device
                MOBILE: /mobile/.test(ua), //Mobile Device (iPad)
                ANDROID_TABLET: false, //Android Tablet
                WINDOWS_TABLET: false, //Windows Tablet
                TABLET: false, //Tablet (iPad, Android, Windows)
                SMART_PHONE: false //Smart Phone (iPhone, Android)
            };

            mua.ANDROID_TABLET = mua.ANDROID && !mua.MOBILE;
            mua.WINDOWS_TABLET = mua.WINDOWS && /tablet/.test(ua);
            mua.TABLET = mua.IPAD || mua.ANDROID_TABLET || mua.WINDOWS_TABLET;
            mua.SMART_PHONE = mua.MOBILE && !mua.TABLET;

            return mua;
        }());
        //SmartPhone
        if (MobileUA.SMART_PHONE) {
            // 移动端链接地址

            document.location.href = "<?php echo url('consult/phone'); ?>";
        }
    });
</script>

<script>
    //调用示例

    layui.use('layer', function(){
        var layer = layui.layer;
        layer.photos({
            photos: '.layer-photos-demo'
            ,anim: 3
        });


    });

</script>


<script>

    $('.btn-success').click(function(){
        var user_id=$(this).attr('value');
        var id=$(this).attr('data-id');
        layui.use('layer', function(){
            var layer = layui.layer;

            layer.prompt({
                formType: 2,
                value: '',
                title: '请输入回复的内容',
                area: ['800px', '350px']
            }, function(value, index, elem){
                $.post("reply.html",{id:id,user_id:user_id,content:value},function(res){
                    layui.use('layer', function(){
                        var layer = layui.layer;
                        layer.msg('回复成功');
                    });
                })
                layer.close(index);
            });
        });

    })






</script>

<!-- Page-Level Scripts -->
<script>
    $(document).ready(function () {
        $('.dataTables-example').dataTable();

        /* Init DataTables */
        var oTable = $('#editable').dataTable();

        /* Apply the jEditable handlers to the table */
        oTable.$('td').editable('../example_ajax.php', {
            "callback": function (sValue, y) {
                var aPos = oTable.fnGetPosition(this);
                oTable.fnUpdate(sValue, aPos[0], aPos[1]);
            },
            "submitdata": function (value, settings) {
                return {
                    "row_id": this.parentNode.getAttribute('id'),
                    "column": oTable.fnGetPosition(this)[2]
                };
            },

            "width": "90%",
            "height": "100%"
        });


    });

    function fnClickAddRow() {
        $('#editable').dataTable().fnAddData([
            "Custom row",
            "New row",
            "New row",
            "New row",
            "New row"]);

    }
</script>


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