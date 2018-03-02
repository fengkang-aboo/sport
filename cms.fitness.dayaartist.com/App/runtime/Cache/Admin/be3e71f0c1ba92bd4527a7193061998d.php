<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="Bookmark" href="/favicon.ico" >
    <link rel="Shortcut Icon" href="/favicon.ico" />
    <!--[if lt IE 9]>
    <script type="text/javascript" src="/Public/admin/lib/html5shiv.js"></script>
    <script type="text/javascript" src="/Public/admin/lib/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="/Public/admin/static/h-ui/css/H-ui.min.css" />
    <link rel="stylesheet" type="text/css" href="/Public/admin/static/h-ui.admin/css/H-ui.admin.css" />
    <link rel="stylesheet" type="text/css" href="/Public/admin/lib/Hui-iconfont/1.0.8/iconfont.css" />
    <link rel="stylesheet" type="text/css" href="/Public/admin/static/h-ui.admin/skin/default/skin.css" id="skin" />
    <link rel="stylesheet" type="text/css" href="/Public/admin/static/h-ui.admin/css/style.css" />
    <!--[if IE 6]>
    <script type="text/javascript" src="/Public/admin/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
    <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->
    <script type="text/javascript" src="/Public/admin/js/jquery.js"></script>
    <script type="text/javascript" src="/Public/admin/js/action.js"></script>

    <title>管理首页</title>
</head>
<script language="javascript" type="text/javascript">

    //js获取日期

    function time()

    {

        var now= new Date();

        var year=now.getFullYear();

        var month=now.getMonth();

        var date=now.getDate();

//写入相应id

        document.getElementById("info1").innerHTML=now;

        document.getElementById("info2").innerHTML="今天是："+year+"年"+(month+1)+"月"+date+"日";

    }

</script>
<body onload="time()">
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 管理后台 <span class="c-gray en">&gt;</span> 管理首页 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<!--<div class="page-container">-->
    <!--<ul class="aaa_pts_show_6">-->
        <!--<li>用户名：  <font><?php echo $_SESSION["admininfo"]['name'] ?></font></li>-->
        <!--<br>-->
        <!--<li>小程序：<font class="r1" style="color:#090"><?php echo $_SESSION["system"]['sysname'] ?></font></li>-->

    <!--</ul>-->
<!--</div>-->

<div class="page-container">
    <p class="f-20 text-success">欢迎使用文艺社<span class="f-14">v1.0</span>小程序商城后台管理系统！</p>
    <table class="table table-border table-bordered table-bg mt-20">
        <thead>
        <tr>
            <th colspan="2" scope="col">文艺社简介</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th width="30%">文艺社</th>
            <td><span id="lbServerName">黑弧数码文化传媒股份有限公司</span></td>
        </tr>
        <tr>
            <td>上海黑弧数码传媒股份有限公司</td>
            <td>上海市徐汇区龙腾大道2937号1-3、1-5室</td>
        </tr>
        <tr>
            <td>上海黑弧数码传媒股份有限公司北京分公司</td>
            <td>北京市朝阳区百子湾路32号二十二院艺术区6号楼20号</td>
        </tr>
        <tr>
            <td>上海黑弧数码传媒股份有限公司广州分公司 </td>
            <td>广州市天河区员村四横路128号红专厂A6</td>
        </tr>
        <tr>
            <td>上海黑弧数码传媒有限公司深圳分公司 </td>
            <td>深圳市南山区华侨城创意文化园F1栋105A-2</td>
        </tr>
        <tr>
            <td>北京黑弧文艺社有限公司 </td>
            <td>北京市朝阳区百子湾路32号二十二院艺术区6号楼20号</td>
        </tr>
        <tr>
            <td>深圳市黑弧文艺社艺术生活传媒有限公司 </td>
            <td>深圳市南山区华侨城创意文化园F1栋105A-2/td>
        </tr>
        <tr>
            <td>黑弧文艺社艺术生活传媒通过社区的文化艺术内容运营及服务，与中国最大量的社区家庭建立“连接”，打造群分时代下泛社区O2O平台，开发商的社区会所资源利用的渠道化，文化艺术生活化内容需求植入的渠道化，泛社区家庭用户社群化、数据化、媒体化、终端化。 </td>
            <td>群分时代下极具行业壁垒针对社区家庭的泛社区O2O的文化艺术生活化平台，一个线上线下以“艺术生活化”极致感受体验的空间，同时也是一个集中艺术、音乐、戏剧、阅读、美食、生活艺术、艺术生活为内容的体验集合地，它以80到90后家庭为单位的主力人群，这群人崇尚人文关怀喜欢文化艺术融入生活的生活模式，相信文化艺术根植的DNA对于身心灵成长的价值，并愿与伴侣和孩子共享文化艺术融入生活，并坚信人文关怀，文化艺术的种子植入自身，家庭及孩子的共生价值。</td>
        </tr>
        <tr>
            <td>服务器脚本超时时间 </td>
            <td>30000秒</td>
        </tr>
        <tr>
            <td>服务器的语言种类 </td>
            <td>Chinese (People's Republic of China)</td>
        </tr>
        <tr>
            <td>服务器当前时间 </td>
            <td id="info1">2014-6-14 12:06:23</td>
        </tr>
        <tr>
            <td>服务器上次启动到现在已运行 </td>
            <td>7210分钟</td>
        </tr>
        </tbody>
    </table>
</div>



</body>
</html>