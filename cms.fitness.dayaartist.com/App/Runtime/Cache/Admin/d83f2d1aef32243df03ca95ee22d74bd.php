<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <!--[if lt IE 9]>
    <script type="text/javascript" src="/sport/cms.fitness.dayaartist.com/Public/lib/html5.js"></script>
    <script type="text/javascript" src="/sport/cms.fitness.dayaartist.com/Public/lib/respond.min.js"></script>
    <script type="text/javascript" src="/sport/cms.fitness.dayaartist.com/Public/lib/PIE_IE678.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="/sport/cms.fitness.dayaartist.com/Public/static/h-ui/css/H-ui.min.css"/>
    <link rel="stylesheet" type="text/css" href="/sport/cms.fitness.dayaartist.com/Public/static/h-ui.admin/css/H-ui.admin.css"/>
    <link rel="stylesheet" type="text/css" href="/sport/cms.fitness.dayaartist.com/Public/lib/Hui-iconfont/1.0.7/iconfont.css"/>
    <link rel="stylesheet" type="text/css" href="/sport/cms.fitness.dayaartist.com/Public/lib/icheck/icheck.css"/>
    <link rel="stylesheet" type="text/css" href="/sport/cms.fitness.dayaartist.com/Public/static/h-ui.admin/skin/default/skin.css" id="skin"/>
    <link rel="stylesheet" type="text/css" href="/sport/cms.fitness.dayaartist.com/Public/static/h-ui.admin/css/style.css"/>
    <link rel="stylesheet" href="/sport/cms.fitness.dayaartist.com/Public/lib/zTree/v3/css/zTreeStyle/zTreeStyle.css" type="text/css">
    <!--[if IE 6]>
    <script type="text/javascript" src="http://lib.h-ui.net/DD_belatedPNG_0.0.8a-min.js"></script>
    <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->
    <style>
        body {
            z-index: 2;
        }

        #zindex {
            background-color: #F0F0F0;
            width: 300px;
            height: 250px;
            position: absolute;
            left: 35%;
            top: 25%;
            border-radius: 10px;
            z-index: 1;
            opacity: 0.9;
            display: none;
        }
    </style>
    <title>供应商列表</title>
</head>
<body class="pos-r">

<div style="margin-left:0px;">
    <nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 场馆管理 <span class="c-gray en">&gt;</span> 场馆列表<a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新"><i class="Hui-iconfont">&#xe68f;</i></a></nav>

    <div class="cl pd-5 bg-1 bk-gray mt-20" style="margin-left: 20px"><span class="l" style="margin-right: 10px"><a
            href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> <a class="btn btn-primary radius" onclick="" href="<?php echo U('Venue/add_venue');?>"><i class="Hui-iconfont">&#xe600;</i> 添加场馆</a></span><a href="<?php echo U('Excels/expSupplier');?>?category_id=<?php echo ($category_id); ?>&status=<?php echo ($status); ?>"><input class="btn btn-success radius" id="aaa" type="button" value="Excel导出"></a> <span class="r">共有数据：<strong><?php echo ($count); ?></strong> 条</span>
    </div>
    <!-- <div style="margin-left: 20px;margin-top: 20px">
        <form class="form form-horizontal" action="" method="post">
            <select name="category_id" style="height: 30px;width: 80px;text-align: center;">
                <option value="">全部分类</option>
                <?php if(is_array($category)): $i = 0; $__LIST__ = $category;if( count($__LIST__)==0 ) : echo "暂时没有数据" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><option value="<?php echo ($v["id"]); ?>"
                    <?php if($v["id"] == $category_id): ?>selected="selected"<?php endif; ?>
                    ><?php echo ($v["name"]); ?></option><?php endforeach; endif; else: echo "暂时没有数据" ;endif; ?>
            </select>&nbsp;
            <select name="status" style="height: 30px;width: 80px;text-align: center;">
                <option value="">状态</option>
                <option value="1"
                <?php if($status == 1): ?>selected="selected"<?php endif; ?>
                >正常</option>
                <option value="2"
                <?php if($status == 2): ?>selected="selected"<?php endif; ?>
                >待审核</option>
            </select>&nbsp;&nbsp;
            <input class="btn btn-success radius" type="submit" value="搜索">
        </form>
    </div> -->
    <div class="page-container">
        <div class="mt-20">
            <table class="table table-border table-bordered table-bg table-hover table-sort">
                <thead>
                <tr class="text-c">
                    <th width="40"><input name="" type="checkbox" value=""></th>
                    <th width="40">ID</th>
                    <th>图片</th>
                    <th>名称</th>
                    <th>原价</th>
                    <th>折扣价</th>
                    <th>状态</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <!-- 遍历 -->
                <?php if(is_array($course)): $i = 0; $__LIST__ = $course;if( count($__LIST__)==0 ) : echo "暂时没有数据" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr class="text-c va-m">
                        <td><input name="" type="checkbox" value=""></td>
                        <td><?php echo ($v["id"]); ?></td>
                        <td><img src="<?php echo ($v["img_url"]); ?>" width="70"></td>
                        <td><?php echo ($v["price"]); ?></td>
                        <td><?php echo ($v["discount_price"]); ?></td>
                        <td><?php echo ($v["status"]); ?></td>
                        <td class="td-status">
                            <?php if($v["status"] == 1): ?><span class="label label-success radius">正常</span>
                                <?php else: ?>
                                <span class="label label-danger radius">关闭</span><?php endif; ?>
                        </td>
                        <td class="td-manage">
                            <a style="text-decoration:none" class="ml-5" href="<?php echo U('Venue/update_venue');?>?id=<?php echo ($v["id"]); ?>" title="编辑">编辑</a>
                        </td>
                    </tr><?php endforeach; endif; else: echo "暂时没有数据" ;endif; ?>
                <!-- 遍历 -->
                </tbody>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript" src="/sport/cms.fitness.dayaartist.com/Public/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/sport/cms.fitness.dayaartist.com/Public/lib/layer/2.1/layer.js"></script>
<script type="text/javascript" src="/sport/cms.fitness.dayaartist.com/Public/lib/My97DatePicker/WdatePicker.js"></script>
<script type="text/javascript" src="/sport/cms.fitness.dayaartist.com/Public/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/sport/cms.fitness.dayaartist.com/Public/lib/zTree/v3/js/jquery.ztree.all-3.5.min.js"></script>
<script type="text/javascript" src="/sport/cms.fitness.dayaartist.com/Public/static/h-ui/js/H-ui.js"></script>
<script type="text/javascript" src="/sport/cms.fitness.dayaartist.com/Public/static/h-ui.admin/js/H-ui.admin.js"></script>
<script type="text/javascript">
    $('.table-sort').dataTable({
        "aaSorting": [[1, "desc"]],//默认第几个排序
        "bStateSave": true,//状态保存
        "aoColumnDefs": [
            {"orderable": false, "aTargets": [0,2,3,6,7]}// 制定列不参与排序
        ]
    });
    //显示修改状态
    $('#up_status').on('click', function () {
        var status = $(this).attr('status');
        if (status == -1) {
            var check_info = $(this).attr('check_info');
            $('#check_info').show();
            $('#check_info').val(check_info);
        }
        $('#zindex').fadeIn();
    })
    //隐藏修改状态
    $(document).on('click', '#butt', function () {

        //$('#butt').on('click',function(){
        var _this = $(this);
        var status = $('input[name="status"]:checked ').val();
        var supplier_id = $(this).attr('ids');
        var check_info = '';
        var str = '';
        if (status == -1) {
            var check_info = $('#check_info').val();
        }
        $.ajax({
            url: 'up_status',
            type: 'GET',
            data: {status: status, check_info: check_info, supplier_id: supplier_id},
            dataType: 'json',
            success: function (data) {
                if (data != 0) {
                    if (data.status != -1) {
                        if (data.status == 1) {
                            str = '<span class="label label-success radius">正常</span>';
                            $('input[name="status"]:eq(0)').attr('checked', 'checked');
                        } else if (data.status == 2) {
                            str = '<span class="label label-secondary radius">待审核</span>';
                            $('input[name="status"]:eq(1)').attr('checked', 'checked');
                        } else if (data.status == 3) {
                            str = '<span class="label label-danger radius">已禁用</span>';
                            $('input[name="status"]:eq(3)').attr('checked', 'checked');
                        }
                    } else {
                        str = '<span class="label label-warning radius">审核不通过</span>';
                        $('input[name="status"]:eq(2)').attr('checked', 'checked');
                        $('#check_info').val(data.check_info);
                    }
                    _this.parent().parent().parent().prev().html(str);
                } else {
                    alert('修改失败');
                }
            }
        })
        $('#zindex').fadeOut();
    })
</script>
</body>
</html>