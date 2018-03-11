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
    <script type="text/javascript" src="/sport/cms.fitness.dayaartist.com/Public/admin/lib/html5shiv.js"></script>
    <script type="text/javascript" src="/sport/cms.fitness.dayaartist.com/Public/admin/lib/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="/sport/cms.fitness.dayaartist.com/Public/admin/static/h-ui/css/H-ui.min.css" />
    <link rel="stylesheet" type="text/css" href="/sport/cms.fitness.dayaartist.com/Public/admin/static/h-ui.admin/css/H-ui.admin.css" />
    <link rel="stylesheet" type="text/css" href="/sport/cms.fitness.dayaartist.com/Public/admin/lib/Hui-iconfont/1.0.8/iconfont.css" />
    <link rel="stylesheet" type="text/css" href="/sport/cms.fitness.dayaartist.com/Public/admin/static/h-ui.admin/skin/default/skin.css" id="skin" />
    <link rel="stylesheet" type="text/css" href="/sport/cms.fitness.dayaartist.com/Public/admin/static/h-ui.admin/css/style.css" />
    <!--[if IE 6]>
    <script type="text/javascript" src="/sport/cms.fitness.dayaartist.com/Public/admin/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
    <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->
    <script type="text/javascript" src="/sport/cms.fitness.dayaartist.com/Public/admin/js/jquery.js"></script>
    <script type="text/javascript" src="/sport/cms.fitness.dayaartist.com/Public/admin/js/action.js"></script>

    <title>管理首页</title>
    <style type="text/css">
    .page-container{
        /*padding: 0;*/
    }
        .container{
            width: 98%;
        }
        .item{
            padding: 15px 30px;
            text-align: center;
        }
        .item a{
            display: inline-block;
        }
        .end{
            display: none;
        }
    </style>
</head>
<script language="javascript" type="text/javascript">

    //js获取日期

</script>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 </nav>


<div class="page-container">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 item">
                <a class="wrap" href="<?php echo U('WXuser/index');?>">
                    <img class="img-responsive center-block start" src="/sport/cms.fitness.dayaartist.com/Public/admin/images/home1.png">
                    <img class="img-responsive center-block end" src="/sport/cms.fitness.dayaartist.com/Public/admin/images/home1a.png">
                </a>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 item">
                <a class="wrap" href="<?php echo U('Venue/venue_index');?>">
                    <img class="img-responsive center-block start" src="/sport/cms.fitness.dayaartist.com/Public/admin/images/home2.png">
                    <img class="img-responsive center-block end" src="/sport/cms.fitness.dayaartist.com/Public/admin/images/home2a.png">
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 item">
                <a class="wrap" href="<?php echo U('Category/index');?>">
                    <img class="img-responsive center-block start" src="/sport/cms.fitness.dayaartist.com/Public/admin/images/home3.png">
                    <img class="img-responsive center-block end" src="/sport/cms.fitness.dayaartist.com/Public/admin/images/home3a.png">
                </a>
            </div>
             <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 item">
                <a class="wrap" href="<?php echo U('Shop/product');?>">
                    <img class="img-responsive center-block start" src="/sport/cms.fitness.dayaartist.com/Public/admin/images/home4.png">
                    <img class="img-responsive center-block end" src="/sport/cms.fitness.dayaartist.com/Public/admin/images/home4a.png">
                </a>
            </div>
            
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 item">
                <a class="wrap" href="<?php echo U('Course/course_index');?>">
                    <img class="img-responsive center-block start" src="/sport/cms.fitness.dayaartist.com/Public/admin/images/home5.png">
                    <img class="img-responsive center-block end" src="/sport/cms.fitness.dayaartist.com/Public/admin/images/home5a.png">
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 item">
                <a class="wrap" href="<?php echo U('Video/video');?>">
                    <img class="img-responsive center-block start" src="/sport/cms.fitness.dayaartist.com/Public/admin/images/home6.png">
                    <img class="img-responsive center-block end" src="/sport/cms.fitness.dayaartist.com/Public/admin/images/home6a.png">
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 item">
                <a class="wrap" href="<?php echo U('Lists/lists');?>">
                    <img class="img-responsive center-block start" src="/sport/cms.fitness.dayaartist.com/Public/admin/images/home7.png">
                    <img class="img-responsive center-block end" src="/sport/cms.fitness.dayaartist.com/Public/admin/images/home7a.png">
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 item">
                <a class="wrap" href="<?php echo U('Statistics/total');?>">
                    <img class="img-responsive center-block start" src="/sport/cms.fitness.dayaartist.com/Public/admin/images/home8.png">
                    <img class="img-responsive center-block end" src="/sport/cms.fitness.dayaartist.com/Public/admin/images/home8a.png">
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 item">
                <a class="wrap" href="<?php echo U('Adminuser/adminuser');?>">
                    <img class="img-responsive center-block start" src="/sport/cms.fitness.dayaartist.com/Public/admin/images/home9.png">
                    <img class="img-responsive center-block end" src="/sport/cms.fitness.dayaartist.com/Public/admin/images/home9a.png">
                </a>
            </div> 


        </div>
    </div>
</div>
<script type="text/javascript">
    $(function(){
        $('.wrap').mouseover(function() {
            $(this).find('.end').show();
        $(this).find('.start').hide();
        console.log(1);
　　});
        $('.wrap').mouseleave(function() {
            $(this).find('.end').hide();
        $(this).find('.start').show();
        console.log(2);
　　});
    })

</script>


</body>
</html>