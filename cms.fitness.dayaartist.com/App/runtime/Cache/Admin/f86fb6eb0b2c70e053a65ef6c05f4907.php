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
 
    <title>添加供应商</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 供应商管理 <span class="c-gray en">&gt;</span> 添加供应商 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新"><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
    <form class="form form-horizontal" action="" method="post" onsubmit="return ac_from();"
          enctype="multipart/form-data">

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>名称：</label>
            <div class="formControls col-xs-8 col-sm-3">
                <input type="text" class="input-text" placeholder="名称：" name="su_name" id="su_name">
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>类型：</label>
            <div class="formControls col-xs-8 col-sm-3"> <span class="select-box">
                <select name="category_id" class="select" id="category_id">
                    <option value="">请选择</option>
                    <?php if(is_array($category_data)): $i = 0; $__LIST__ = $category_data;if( count($__LIST__)==0 ) : echo "暂时没有数据" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><option value="<?php echo ($v["id"]); ?>">--<?php echo ($v["name"]); ?></option><?php endforeach; endif; else: echo "暂时没有数据" ;endif; ?>
                </select>
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>分店：</label>
            <div class="formControls col-xs-8 col-sm-3" id="add_course"><span class="select-box" style="margin-bottom:6px">
                <select name="category_id" class="select" id="chain">
                    <option value="">请选择</option>
                    <?php if(is_array($chain_data)): $i = 0; $__LIST__ = $chain_data;if( count($__LIST__)==0 ) : echo "暂时没有数据" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><option value="<?php echo ($v["id"]); ?>">--<?php echo ($v["ch_name"]); ?></option><?php endforeach; endif; else: echo "暂时没有数据" ;endif; ?>
                </select>
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">邮箱：</label>
            <div class="formControls col-xs-8 col-sm-3">
                <input type="text" class="input-text" placeholder="邮箱" name="su_email" id="su_email">
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">地址：</label>
            <div class="formControls col-xs-8 col-sm-3">
                <input type="text" class="input-text" placeholder="地址" name="su_adress" id="su_adress">
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">描述：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <textarea style="width:90%" name="description" cols="" rows="" class="textarea" placeholder="说点什么...最少输入10个字符" datatype="*10-100" dragonfly="true" nullmsg="备注不能为空！" onKeyUp="textarealength(this,200)"></textarea>
                <p class="textarea-numberbar"><em class="textarea-length">0</em>/200</p>
            </div>
        </div>

        <div class="row cl">
            <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
                <input class="btn btn-primary radius" type="submit"  value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
            </div>
        </div>
    </form>
</div>

<!--_footer 作为公共模版分离出去-->


<script>
    $('#chain').on('change',function(){
        var chain_id = $(this).val();
        if (!chain_id) {
            alert('请选择分店');
            $('#rem').remove();return;
        }
        var str = '<div id="rem"><span class="select-box"><select name="sid" class="select" id="sid"><option value="">请选择</option>';
        $.ajax({
            url  : 'chain_box',
            typr : 'GET',
            data : {chain_id:chain_id},
            dataType : 'json',
            success : function(data){
                if (data != 0) {
                    //console.log(typeof data);return;
                    $.each(data,function(i,j){
                        str += '<option value="'+j.sid+'">'+j.name+'</option>';
                    })
                    /*var data = eval('(' + data + ')'); 
                    for(var i=0;i<data.length;i++){
                        str+='<option value="'+data[i].sid+'">'+data[i].name+'</option>';
                        console.log(1)
                    }*/
                   str += '</select></div>'; 
                    $('#add_course').append(str);
                }else{
                    alert('该分店没有空间服务')
                }
            }
        })
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