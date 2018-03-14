<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <link rel="Bookmark" href="/cms.fitness.dayaartist.com/Public/admin/images/favicon.ico">
    <link rel="Shortcut Icon" href="/cms.fitness.dayaartist.com/Public/admin/images/favicon.ico"/>
    <!--[if lt IE 9]>
    <script type="text/javascript" src="/cms.fitness.dayaartist.com/Public/admin/lib/html5shiv.js"></script>
    <script type="text/javascript" src="/cms.fitness.dayaartist.com/Public/admin/lib/respond.min.js"></script>
    <![endif]-->
    <link href="/cms.fitness.dayaartist.com/Public/admin/static/h-ui/css/H-ui.min.css" rel="stylesheet" type="text/css"/>
    <link href="/cms.fitness.dayaartist.com/Public/admin/static/h-ui.admin/css/H-ui.login.css" rel="stylesheet" type="text/css"/>
    <link href="/cms.fitness.dayaartist.com/Public/admin/static/h-ui.admin/css/style.css" rel="stylesheet" type="text/css"/>
    <link href="/cms.fitness.dayaartist.com/Public/admin/lib/Hui-iconfont/1.0.8/iconfont.css" rel="stylesheet" type="text/css"/>
    <!--[if IE 6]>
    <script type="text/javascript" src="/cms.fitness.dayaartist.com/Public/admin/lib/DD_belatedPNG_0.0.8a-min.js"></script>
    <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->
    <title>区块练后台管理系统</title>
    <style type="text/css">
        input{
            border:none;
            outline: none;
        }
        .login-logo{
            width: 194px;
            height: 92px;
            position: absolute;
            left: 50%;
            top: -150px;
            margin-left: -87px;
        }
    </style>
</head>
<body>
<input type="hidden" id="TenantId" name="TenantId" value=""/>

<div class="loginWraper">
    <div id="loginform" class="loginBox">
        <div class="login-logo"><img src="/cms.fitness.dayaartist.com/Public/admin/static/h-ui.admin/images/logo.png" alt=""></div>
        <form name="Form1" class="form form-horizontal" action="?key=<?php echo $key;?>" method="post" id="Form1"
              onsubmit="return chkForm()">
            <div class="row cl">
                <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60d;</i></label>
                <div class="formControls col-xs-8">

                    <input style="border:none;outline: none;background: rgba(255,255,255,.4);color: #0b3d3b" placeholder="输入管理账号" id="username" name="username" class="input-text size-L" type="text"/>
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60e;</i></label>
                <div class="formControls col-xs-8">

                    <input style="border:none;outline: none;background: rgba(255,255,255,.4);color: #0b3d3b" placeholder="输入管理密码" type="password" id="pwd" name="pwd" class="input-text size-L"/>
                </div>
            </div>

            <div class="row cl">
                <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe63f;</i></label>
                <div class="formControls col-xs-4">
                    <input class="input-text size-L" type="text" name="code" id="login_code" value='图片验证码'
                           style="border:none;outline: none;font-size:14px;color:#0b3d3b;text-align:left;text-indent:1em;width: 100%;background: rgba(255,255,255,.4)"
                           onfocus="if(value=='图片验证码'){value=''}" onblur="if(value==''){value='图片验证码'}"/>
                </div>
                <div class="formControls col-xs-3">
                    <img style="width: 123px;margin-left: 20px;" src="<?php echo U('Admin/Login/code');?>" onclick="huan(this)"/>
                </div>
                <br/>
            </div>


            <div class="row cl">
                <div class="formControls col-xs-8 col-xs-offset-3">
                    <input style="border:none;outline: none;width: 360px;height: 40px;background-image: linear-gradient(90deg, #00bed1 0%, #00d0b9 100%);>" name="" type="submit" class="btn btn-success radius size-L"
                           value="&nbsp;登&nbsp;&nbsp;&nbsp;&nbsp;录&nbsp;">
           <!--          <input name="" type="reset" class="btn btn-default radius size-L"
                           value="&nbsp;取&nbsp;&nbsp;&nbsp;&nbsp;消&nbsp;"> -->
                </div>
            </div>
        </form>
    </div>
</div>
<!-- <div class="footer">Copyright 小程序 by H-ui.admin v3.0</div> -->
<script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="static/h-ui/js/H-ui.min.js"></script>


<script>
    window.onload = function(){
        if (window.top!=null && window.top.document.URL!=document.URL){    
            window.top.location= 'http://shop.com/index.php/Admin/Login/index.html';     
        } 
    };
    var username = document.getElementById("username");
    var pwd = document.getElementById("pwd");

    function chkForm() {
        if (username.value == '') {
            alert('用户名不能为空！');
            username.focus();
            return false;
        }
        if (pwd.value == '') {
            alert('密码不能为空！');
            pwd.focus();
            return false;
        }
    }
</script>
<script>
    function huan(tag) {
        tag.src = "<?php echo u('Admin/Login/code');?>?id=" + Math.random();
    }
</script>
<!--此乃百度统计代码，请自行删除-->

<!--/此乃百度统计代码，请自行删除
</body>
</html>