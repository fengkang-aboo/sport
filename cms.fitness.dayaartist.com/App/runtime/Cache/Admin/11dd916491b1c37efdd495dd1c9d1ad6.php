<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <LINK rel="Bookmark" href="/Public/favicon.ico">
    <LINK rel="Shortcut Icon" href="/Public/favicon.ico"/>
    <!--[if lt IE 9]>
    <script type="text/javascript" src="lib/html5.js"></script>
    <script type="text/javascript" src="lib/respond.min.js"></script>
    <script type="text/javascript" src="lib/PIE_IE678.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="/Public/static/h-ui/css/H-ui.min.css"/>
    <link rel="stylesheet" type="text/css" href="/Public/static/h-ui.admin/css/H-ui.admin.css"/>
    <link rel="stylesheet" type="text/css" href="/Public/lib/Hui-iconfont/1.0.7/iconfont.css"/>
    <link rel="stylesheet" type="text/css" href="/Public/lib/icheck/icheck.css"/>
    <link rel="stylesheet" type="text/css" href="/Public/static/h-ui.admin/skin/default/skin.css" id="skin"/>
    <link rel="stylesheet" type="text/css" href="/Public/static/h-ui.admin/css/style.css"/>
    <!--[if IE 6]>
    <script type="text/javascript" src="http://lib.h-ui.net/DD_belatedPNG_0.0.8a-min.js"></script>
    <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->
    <!--/meta 作为公共模版分离出去-->

    <link href="/Public/lib/webuploader/0.1.5/webuploader.css" rel="stylesheet" type="text/css"/>
    <style type="text/css">
        .item {
            width: 100%;
            border-bottom: dashed 1px #ccc;
            text-align: center;
            padding: 30px 0
        }

        .item > textarea {
            width: 100%;

        }

        .item .pre-img {
            width: 400px;
            margin: auto;
            height: auto;
        }

        .item .item-file {
            /*font-size: 20px;
            font-weight: bold;*/
            /*opacity: 0;*/
        }

        .item-add {
            width: 200px;
            height: 40px;
            line-height: 4 0px;
            border-radius: 8px;
            color: #fff;
            background: #00b7ee;
            margin: 30px auto;
            border: none;
            outline: none;
            display: block;
            font-size: 16px;
            text-align: center;
            line-height: 40px;

        }
    </style>
</head>
<body>
<div class="page-container">
    <form action="" method="post" class="form form-horizontal" id="form-article-add" enctype="multipart/form-data">
        <div class="row cl">
            <input type="hidden" name="product_id" value="<?php echo ($id); ?>">
            <input type="hidden" name="summary" value="<?php echo ($summary); ?>">
            <label class="form-label col-xs-4 col-sm-2">商品详情：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <div style="border: solid 1px #ccc;padding: 20px" class="item-wrapper">
                    <div class="item">
                        标题：<input type="text" name="title" class="input-text" style="width:90%"><br>
                        排序：<input type="text" name="order" class="input-text" style="width:90%"><br>
                        描述：<textarea placeholder="请输入商品详情文字" rows="3" name="content"></textarea>
                        <div><img class="pre-img" src=""></div>
                        <input class="item-file" type="file" name="file">
                    </div>
                </div>
            </div>
        </div>
        <div class="row cl">
            <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
                <button onClick="article_save_submit();" class="btn btn-primary radius" type="submit"><i
                        class="Hui-iconfont">&#xe632;</i> 保存提交
                </button>
                <button onClick="javascript:history.back(-1);" class="btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
            </div>
        </div>
    </form>
</div>

<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/Public/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript">

</script>
</body>
</html>