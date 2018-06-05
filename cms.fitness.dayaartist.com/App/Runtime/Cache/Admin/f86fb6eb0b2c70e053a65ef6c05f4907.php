<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <link rel="Bookmark" href="/favicon.ico">
    <link rel="Shortcut Icon" href="/favicon.ico"/>
    <link href="/Public/admin/css/main.css" rel="stylesheet" type="text/css"/>
    <!--[if lt IE 9]>
    <script type="text/javascript" src="/Public/admin/lib/html5shiv.js"></script>
    <script type="text/javascript" src="/Public/admin/lib/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="/Public/admin/static/h-ui/css/H-ui.min.css"/>
    <link rel="stylesheet" type="text/css" href="/Public/admin/static/h-ui.admin/css/H-ui.admin.css"/>
    <link rel="stylesheet" type="text/css" href="/Public/admin/lib/Hui-iconfont/1.0.8/iconfont.css"/>
    <link rel="stylesheet" type="text/css" href="/Public/admin/static/h-ui.admin/skin/default/skin.css" id="skin"/>
    <link rel="stylesheet" type="text/css" href="/Public/admin/static/h-ui.admin/css/style.css"/>
    <!--[if IE 6]>
    <script type="text/javascript" src="/Public/admin/lib/DD_belatedPNG_0.0.8a-min.js"></script>
    <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->
    <script type="text/javascript" src="/Public/lib/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript" src="/Public/admin/js/action.js"></script>
    <script type="text/javascript" src="/Public/plugins/xheditor/xheditor-1.2.1.min.js"></script>
    <script type="text/javascript" src="/Public/plugins/xheditor/xheditor_lang/zh-cn.js"></script>
    <script type="text/javascript" src="/Public/admin/js/jCalendar.js"></script>

    <script type="text/javascript" src="/Public/static/h-ui/js/H-ui.js"></script>
 
    <title>添加场馆</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 场馆管理 <span class="c-gray en">&gt;</span> 添加场馆 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新"><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
    <form class="form form-horizontal" action="" method="post" onsubmit="return ac_from();" enctype="multipart/form-data">
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>名称：</label>
            <div class="formControls col-xs-8 col-sm-3">
                <input type="text" class="input-text" placeholder="名称" name="name" id="name" value="<?php echo ($venue["name"]); ?>">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">联络人：</label>
            <div class="formControls col-xs-8 col-sm-3">
                <input type="text" class="input-text" placeholder="联络人" name="contacts" id="contacts" value="<?php echo ($venue["contacts"]); ?>">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">电话：</label>
            <div class="formControls col-xs-8 col-sm-3">
                <input type="text" class="input-text" placeholder="电话" name="tel" id="tel" value="<?php echo ($venue["tel"]); ?>">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">营业时间：</label>
            <div class="formControls col-xs-8 col-sm-3">
                <input type="text" class="input-text" placeholder="营业时间" name="business_hours" id="business_hours" value="<?php echo ($venue["business_hours"]); ?>">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">地址：</label>
            <div class="formControls col-xs-8 col-sm-3">
                <input type="text" class="input-text" placeholder="地址" name="address" id="address" value="<?php echo ($venue["address"]); ?>">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">经度：</label>
            <div class="formControls col-xs-8 col-sm-3">
                <input type="text" class="input-text" placeholder="经度" name="longitude" id="longitude" value="<?php echo ($venue["longitude"]); ?>">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">纬度：</label>
            <div class="formControls col-xs-8 col-sm-3">
                <input type="text" class="input-text" placeholder="纬度" name="latitude" id="latitude" value="<?php echo ($venue["latitude"]); ?>">
            </div>
        </div>
        <!--<div class="row cl">-->
            <!--<label class="form-label col-xs-4 col-sm-3">分类：</label>-->
            <!--<div class="formControls col-xs-8 col-sm-6">-->
                <!--<?php if(is_array($category)): $i = 0; $__LIST__ = $category;if( count($__LIST__)==0 ) : echo "暂时没有数据" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>-->
                    <!--<input type="checkbox" name="category_id[]" value="<?php echo ($v["id"]); ?>" class="facilities"> <?php echo ($v["name"]); ?>&nbsp;&nbsp;-->
                <!--<?php endforeach; endif; else: echo "暂时没有数据" ;endif; ?>-->
            <!--</div>-->
        <!--</div>-->
        <!--<div class="row cl">-->
            <!--<label class="form-label col-xs-4 col-sm-3">基础设施：</label>-->
            <!--<div class="formControls col-xs-8 col-sm-6">-->
                <!--<?php if(is_array($facilities)): $i = 0; $__LIST__ = $facilities;if( count($__LIST__)==0 ) : echo "暂时没有数据" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>-->
                    <!--<input type="checkbox" name="facilities_id[]" value="<?php echo ($v["id"]); ?>" class="facilities"> <?php echo ($v["name"]); ?>&nbsp;&nbsp;-->
                <!--<?php endforeach; endif; else: echo "暂时没有数据" ;endif; ?>-->
            <!--</div>-->
        <!--</div>-->
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">场馆介绍：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <textarea style="width:90%" name="content" cols="" rows="" class="textarea" placeholder="说点什么...最少输入10个字符" datatype="*10-100" dragonfly="true" nullmsg="备注不能为空！" onKeyUp="textarealength(this,300)"><?php echo ($venue["content"]); ?></textarea>
                <p class="textarea-numberbar"><em class="textarea-length">0</em>/300</p>
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">注意事项：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <textarea style="width:90%" name="follow" cols="" rows="" class="textarea" placeholder="说点什么...最少输入10个字符" datatype="*10-100" dragonfly="true" nullmsg="备注不能为空！" onKeyUp="textarealength(this,200)"><?php echo ($venue["follow"]); ?></textarea>
                <p class="textarea-numberbar"><em class="textarea-length">0</em>/200</p>
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>LOGO：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="file" name="logo" id="logo">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>场馆主图：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="file" name="venue_img" id="venue_img">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>轮播图片：</label>
            <div class="formControls col-xs-8 col-sm-9" id='addImg'>+多张</div>
            <div class="formControls col-xs-8 col-sm-9" id='venue_imgs'>
                <input type="file" name="venue_imgs[]">
            </div>
        </div>
        <div class="row cl">
            <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
                <input type="hidden" name="id" value="<?php echo ($venue["id"]); ?>">
                <input class="btn btn-primary radius" type="submit"  value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
            </div>
        </div>
    </form>
</div>

<!--_footer 作为公共模版分离出去-->


<script>
    $('#addImg').on('click',function(){
        var str = "<input type='file' name='venue_imgs[]'>";
        $('#venue_imgs').append(str);
    })

    $('.facilities').on('click',function(){
        var num = $("input[type='checkbox']:checked").length;
        if (num > 10) {
            $(this).attr('checked',false);
            alert('最多选十项');
        }
    })

    //验证表单空值
    function ac_from(){

        var su_name=document.getElementById('su_name').value;
        if(su_name.length<1){
            alert('供应商名称不能为空');
            return false;
        }

        var category_id=document.getElementById("category_id").value;
        if(!category_id){
            alert("请选择分类");
            return false;
        }

        var sid=document.getElementById("sid").value;
        if(!sid){
            alert("请选择盒子");
            return false;
        }
    }
</script>

</body>
</html>