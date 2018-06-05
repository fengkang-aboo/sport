<?php if (!defined('THINK_PATH')) exit();?><!--_meta 作为公共模版分离出去-->
<!DOCTYPE HTML>
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
    </style>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 课程管理 <span
        class="c-gray en">&gt;</span> 添加课程 <a class="btn btn-success radius r"
                                              style="line-height:1.6em;margin-top:3px"
                                              href="javascript:location.replace(location.href);" title="刷新"><i
        class="Hui-iconfont">&#xe68f;</i></a></nav>

<div class="page-container">
    <form action="" method="post" class="form form-horizontal" id="form-article-add" onsubmit="return ac_from();"
          enctype="multipart/form-data">
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>课程名称：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" style="width:90%" name="name" id="name" value="<?php echo ($course["name"]); ?>"
                       placeholder="请填写课程名称信息">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>课程分类：</label>
            <div class="formControls col-xs-8 col-sm-9"> <span class="select-box" style="width:90%">
                    <select name="type_id" class="select" id="type_id">
                        <option value="">课程分类</option>
                        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$op1): $mod = ($i % 2 );++$i;?><option value="<?php echo ($op1["id"]); ?>" id="cate_<?php echo ($op1["id"]); ?>" name="one" <?php if($op1["id"] == $course['venue_branch_id']): ?>selected="selected"<?php endif; ?> >- <?php echo ($op1["name"]); ?></option>
                            <?php if(is_array($op1['list2'])): $i = 0; $__LIST__ = $op1['list2'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$op2): $mod = ($i % 2 );++$i;?><option value="<?php echo ($op2["id"]); ?>" id="cate_<?php echo ($op2["id"]); ?>"
                                            name="two">&nbsp; &nbsp;- <?php echo ($op2["name"]); ?></option>
                                <?php if(is_array($op2['list3'])): $i = 0; $__LIST__ = $op2['list3'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$op3): $mod = ($i % 2 );++$i;?><option value="<?php echo ($op3["id"]); ?>" id="cate_<?php echo ($op3["id"]); ?>" name="three">&nbsp; &nbsp;&nbsp; &nbsp;- <?php echo ($op3["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </span>
            </div>
        </div>
        <?php if($venue_id == '' ): ?><div class="row cl">
                <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>场馆：</label>
                <div class="formControls col-xs-8 col-sm-9"> <span class="select-box" style="width:90%">
                        <select name="venue_branch_id" id="venue_branch_id" class="select">
                            <option value="">场馆列表</option>
                            <?php if(is_array($venueList)): $i = 0; $__LIST__ = $venueList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$venueList): $mod = ($i % 2 );++$i;?><option value="<?php echo ($venueList["id"]); ?>" name="one" <?php if($venueList["id"] == $course['venue_branch_id']): ?>selected="selected"<?php endif; ?> >- <?php echo ($venueList["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </span>
                </div>
            </div>
        <?php else: ?> 
            <input type="hidden" name="venue_branch_id" value="<?php echo ($venue_id); ?>"><?php endif; ?>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>课程描述：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" name="content" value="<?php echo ($course["content"]); ?>" class="input-text" placeholder="请填写课程内容描述"
                       style="width:90%">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>价格：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" name="price" value="<?php echo ($course["price"]); ?>" class="input-text" style="width:90%"
                       placeholder="请填写价格">
                元
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">折扣价：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" name="discount_price" value="<?php echo ($course["discount_price"]); ?>" class="input-text"
                       style="width:90%"
                       placeholder="请填写折扣价格">
                元
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>商品图片：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="file" name="main_img" value="">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>轮播图片：</label>
            <div class="formControls col-xs-8 col-sm-9" id='addImg'>+多张</div>
            <div class="formControls col-xs-8 col-sm-9" id='venue_imgs'>
                <input type="file" name="venue_imgs[]">
            </div>
        </div>
        <div class="row cl">
            <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
                <button onClick="article_save_submit();" class="btn btn-primary radius" type="submit"><i
                        class="Hui-iconfont">&#xe632;</i>
                    保存提交
                </button>
                <input type="hidden" name="id" id='id' value="<?php echo ($course["id"]); ?>">
                <input type="hidden" name="main_img_id" id='main_img_id' value="<?php echo ($course["main_img_id"]); ?>">
                <input type="hidden" name="img_id" id='img_id' value="<?php echo ($course["img_id"]); ?>">
                <button id="back" class="btn btn-default radius" type="button">
                    &nbsp;&nbsp;取消&nbsp;&nbsp;
                </button>
            </div>
        </div>
    </form>
</div>

<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/Public/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/Public/lib/layer/2.1/layer.js"></script>
<script type="text/javascript" src="/Public/lib/icheck/jquery.icheck.min.js"></script>
<script type="text/javascript" src="/Public/lib/jquery.validation/1.14.0/jquery.validate.min.js"></script>
<script type="text/javascript" src="/Public/lib/jquery.validation/1.14.0/validate-methods.js"></script>
<script type="text/javascript" src="/Public/lib/jquery.validation/1.14.0/messages_zh.min.js"></script>
<script type="text/javascript" src="/Public/static/h-ui/js/H-ui.js"></script>
<script type="text/javascript" src="/Public/static/h-ui.admin/js/H-ui.admin.js"></script>
<!--/_footer /作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/Public/lib/webuploader/0.1.5/webuploader.min.js"></script>
<script type="text/javascript" src="/Public/lib/ueditor/1.4.3/ueditor.config.js"></script>
<script type="text/javascript" src="/Public/lib/ueditor/1.4.3/ueditor.all.min.js"></script>
<script type="text/javascript" src="/Public/lib/ueditor/1.4.3/lang/zh-cn/zh-cn.js"></script>
<script type="text/javascript" src="/Public/lib/My97DatePicker/WdatePicker.js"></script>
<script type="text/javascript">
    //    增加图片上传
    $('#addImg').on('click',function(){
        var str = "<input type='file' name='venue_imgs[]'>";
        $('#venue_imgs').append(str);
    })

    //验证表单空值
    function ac_from() {
        var name = document.getElementById('name').value;
        if (name.length < 1) {
            alert('课程名称不能为空');
            return false;
        }
        var artist_id = document.getElementById('venue_branch_id').value;
        if (artist_id.length < 1) {
            alert("请选择分店信息");
            return false;
        }
        var unit = document.getElementById("type_id").value;
        if (unit.length < 1) {
            alert("课程分类不能为空");
            return false;
        }
    }
</script>
</body>
</html>