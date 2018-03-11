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
    <LINK rel="Bookmark" href="/sport/cms.fitness.dayaartist.com/Public/favicon.ico">
    <LINK rel="Shortcut Icon" href="/sport/cms.fitness.dayaartist.com/Public/favicon.ico"/>
    <!--[if lt IE 9]>
    <script type="text/javascript" src="lib/html5.js"></script>
    <script type="text/javascript" src="lib/respond.min.js"></script>
    <script type="text/javascript" src="lib/PIE_IE678.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="/sport/cms.fitness.dayaartist.com/Public/static/h-ui/css/H-ui.min.css"/>
    <link rel="stylesheet" type="text/css" href="/sport/cms.fitness.dayaartist.com/Public/static/h-ui.admin/css/H-ui.admin.css"/>
    <link rel="stylesheet" type="text/css" href="/sport/cms.fitness.dayaartist.com/Public/lib/Hui-iconfont/1.0.7/iconfont.css"/>
    <link rel="stylesheet" type="text/css" href="/sport/cms.fitness.dayaartist.com/Public/lib/icheck/icheck.css"/>
    <link rel="stylesheet" type="text/css" href="/sport/cms.fitness.dayaartist.com/Public/static/h-ui.admin/skin/default/skin.css" id="skin"/>
    <link rel="stylesheet" type="text/css" href="/sport/cms.fitness.dayaartist.com/Public/static/h-ui.admin/css/style.css"/>
    <!--[if IE 6]>
    <script type="text/javascript" src="http://lib.h-ui.net/DD_belatedPNG_0.0.8a-min.js"></script>
    <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->
    <!--/meta 作为公共模版分离出去-->

    <link href="/sport/cms.fitness.dayaartist.com/Public/lib/webuploader/0.1.5/webuploader.css" rel="stylesheet" type="text/css"/>
    <style type="text/css">
    </style>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 服务产品 <span
        class="c-gray en">&gt;</span> 课程添加 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px"
                                              href="javascript:location.replace(location.href);" title="刷新"><i
        class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
    <form class="form form-horizontal" action="<?php echo U('Video/add');?>" method="post" onsubmit="return ac_from();"
          enctype="multipart/form-data">
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>视频名称：</label>
            <div class="formControls col-xs-8 col-sm-3">
                <input type="text" class="input-text" placeholder="请添加视频名称" name="name" id="name" value="<?php echo ($video["name"]); ?>">
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>副标题：</label>
            <div class="formControls col-xs-8 col-sm-3">
                <input type="text" class="input-text" placeholder="请添加副标题" name="describe" id="describe"
                       value="<?php echo ($video["describe"]); ?>">
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>详情：</label>
            <!--<div class="formControls col-xs-8 col-sm-3">-->
            <!--<input type="text" class="input-text" placeholder="请添加详情" name="content" id="content"-->
            <!--value="<?php echo ($video["content"]); ?>">-->
            <!--</div>-->
            <div class="formControls col-xs-8 col-sm-6">
                <script id="editor" type="text/plain" style="width:100%;height:400px;"><?php echo (htmlspecialchars_decode($video["content"])); ?></script>
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>选择分类：</label>
            <div class="formControls col-xs-8 col-sm-3">
                <select class="inp_1" name="category_id" id="category_id" onchange="getcid();"
                        style="width:150px;margin-right:5px;">
                    <!-- 遍历 -->
                    <option value="">视频分类</option>
                    <?php if(is_array($category)): $i = 0; $__LIST__ = $category;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><option value="<?php echo ($v["id"]); ?>"
                        <?php if($v["id"] == $video['category_id']): ?>selected="selected"<?php endif; ?>
                        >-- <?php echo ($v["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                    <!-- 遍历 -->
                </select>
                <br>
                <span id="catedesc" style="color:red;font-size: 12px;">&nbsp;&nbsp; * 必选项</span>
            </div>
        </div>


        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>视频链接：</label>
            <div class="formControls col-xs-8 col-sm-3">
                <input type="text" class="input-text" placeholder="请添加视频链接：" name="main_video_url" id="main_video_url"
                       value="<?php echo ($video["main_video_url"]); ?>">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>时长：</label>
            <div class="formControls col-xs-8 col-sm-3">
                <input type="text" class="input-text" placeholder="请添加时长" name="duration" id="duration"
                       value="<?php echo ($video["duration"]); ?>">
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>视频封面：</label>
            <div class="formControls col-xs-8 col-sm-3">
                <?php if ($video.main_img_url) { ?>
                <img src="https://api.joyfamliy.com/images_literature<?php echo ($video["main_img_url"]); ?>" width="250"
                     style="margin-bottom: 3px;"/>
                <br/>
                <?php } ?>
                <input type="file" name="file" id="file"/>
            </div>
        </div>
        <div class="row cl">
            <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
                <button onClick="" class="btn btn-primary radius" type="submit"><i
                        class="Hui-iconfont">&#xe632;</i> 保存并提交审核
                </button>
                <input type="hidden" name="id" id='id' value="<?php echo ($video["id"]); ?>">
                <input type="hidden" name="main_img_url" id='main_img_url' value="<?php echo ($video["main_img_url"]); ?>">
                <button onClick="self.location=document.referrer;" class="btn btn-default radius" type="button">
                    &nbsp;&nbsp;取消&nbsp;&nbsp;
                </button>
            </div>
        </div>
    </form>
</div>

<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/sport/cms.fitness.dayaartist.com/Public/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/sport/cms.fitness.dayaartist.com/Public/lib/layer/2.1/layer.js"></script>
<script type="text/javascript" src="/sport/cms.fitness.dayaartist.com/Public/lib/icheck/jquery.icheck.min.js"></script>
<script type="text/javascript" src="/sport/cms.fitness.dayaartist.com/Public/lib/jquery.validation/1.14.0/jquery.validate.min.js"></script>
<script type="text/javascript" src="/sport/cms.fitness.dayaartist.com/Public/lib/jquery.validation/1.14.0/validate-methods.js"></script>
<script type="text/javascript" src="/sport/cms.fitness.dayaartist.com/Public/lib/jquery.validation/1.14.0/messages_zh.min.js"></script>
<script type="text/javascript" src="/sport/cms.fitness.dayaartist.com/Public/static/h-ui/js/H-ui.js"></script>
<script type="text/javascript" src="/sport/cms.fitness.dayaartist.com/Public/static/h-ui.admin/js/H-ui.admin.js"></script>
<!--/_footer /作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/sport/cms.fitness.dayaartist.com/Public/lib/webuploader/0.1.5/webuploader.min.js"></script>
<script type="text/javascript" src="/sport/cms.fitness.dayaartist.com/Public/lib/ueditor/1.4.3/ueditor.config.js"></script>
<script type="text/javascript" src="/sport/cms.fitness.dayaartist.com/Public/lib/ueditor/1.4.3/ueditor.all.min.js"></script>
<script type="text/javascript" src="/sport/cms.fitness.dayaartist.com/Public/lib/ueditor/1.4.3/lang/zh-cn/zh-cn.js"></script>
<script type="text/javascript">
    $(function () {
        var ue = UE.getEditor('editor');
    });

    function ac_from() {

        var name = document.getElementById('name').value;
        if (name.length < 1) {
            alert('视频名称不能为空');
            return false;
        }

        var describe = document.getElementById('describe').value;
        if (describe.length < 1) {
            alert('视频副标题不能为空');
            return false;
        }
        elseif(describe.length > 40)
        {
            alert('视频副标题字数不能超过20');
            return false;
        }

        var cid = parseInt(document.getElementById("category_id").value);
        if (!cid) {
            alert("请选择分类.");
            return false;
        }

        var content = document.getElementById('content').value;
        var main_video_url = document.getElementById('main_video_url').value;
        var duration = document.getElementById('duration').value;
        if (content.length < 1) {
            alert('请填写必要信息');
            return false;
        }
        if (main_video_url.length < 1) {
            alert('请填写必要信息');
            return false;
        }
        if (duration.length < 1) {
            alert('请填写必要信息');
            return false;
        }


        //  var pid=parseInt(document.getElementById("shop_id").value);
        // if(isNaN(pid) || pid<1){
        //  alert("请选择所属商家");
        //  return false;
        // }

    }

</script>
</body>
</html>