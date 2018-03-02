<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <link rel="stylesheet" type="text/css" href="/Public/static/h-ui/css/H-ui.min.css"/>
    <link rel="stylesheet" type="text/css" href="/Public/static/h-ui.admin/css/H-ui.admin.css"/>
    <link rel="stylesheet" type="text/css" href="/Public/lib/Hui-iconfont/1.0.7/iconfont.css"/>
    <link rel="stylesheet" type="text/css" href="/Public/lib/icheck/icheck.css"/>
    <link rel="stylesheet" type="text/css" href="/Public/static/h-ui.admin/skin/default/skin.css" id="skin"/>
    <link rel="stylesheet" type="text/css" href="/Public/static/h-ui.admin/css/style.css"/>
    <title>分店列表</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 服务产品 <span class="c-gray en">&gt;</span> 空间服务 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新"><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
    <div class="cl pd-5 bg-1 bk-gray mt-20"><span class="l"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> <a class="btn btn-primary radius" href="<?php echo U('Course/operation');?>"><i class="Hui-iconfont">&#xe600;</i> 添加空间</a></span> <span class="r">共有数据：<strong><?php echo ($num); ?></strong> 条</span></div>
    <div class="mt-20">
        <table class="table table-border table-bordered table-bg table-hover table-sort">
            <thead>
            <tr class="text-c">
                <th width="30"><input name="" type="checkbox" value=""></th>
                <th width="40">ID</th>
                <th>名称</th>
                <th>分类</th>
                <th>地址</th>
                <th>设备名称</th>
                <th>上限</th>
                <th>状态</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <?php if(is_array($course_data)): $i = 0; $__LIST__ = $course_data;if( count($__LIST__)==0 ) : echo "暂时没有数据" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr class="text-c">
                    <td><input name="" type="checkbox" value=""></td>
                    <td><?php echo ($v["sid"]); ?></td>
                    <td><?php echo ($v["course_name"]); ?></td>
                    <td class="text-c"><?php echo ($v["cate_name"]); ?></td>
                    <td><?php echo ($v["address"]); ?></td>
                    <td><?php echo ($v["device_name"]); ?></td>
                    <td><?php echo ($v["relationship"]); ?></td>
                    <td class="td-status">
                        <?php if($v["status"] == 1): ?><span class="label label-success radius">正常</span>
                        <?php else: ?>
                            <span class="label label-defaunt radius">禁用</span><?php endif; ?>
                    </td>
                    <td class="td-manage">
                        <?php if($v["status"] == 1): ?><a style="text-decoration:none" href="javascript:;" title="正常" status="<?php echo ($v["status"]); ?>" course_id="<?php echo ($v["sid"]); ?>" class="check_status"><i class="Hui-iconfont">&#xe631;</i></a>
                        <?php else: ?>
                            <a style="text-decoration:none" href="javascript:;" title="禁用" status="<?php echo ($v["status"]); ?>" course_id="<?php echo ($v["sid"]); ?>" class="check_status"><i class="Hui-iconfont">&#xe6e1;</i></a><?php endif; ?>
                        <a style="text-decoration:none" class="ml-5" onClick=""
                           href="<?php echo U('Course/operation');?>?id=<?php echo ($v["sid"]); ?>" title="修改"><i class="Hui-iconfont">&#xe6df;</i></a>
                    </td>
                </tr><?php endforeach; endif; else: echo "暂时没有数据" ;endif; ?>
            </tbody>
        </table>
    </div>
</div>
<script type="text/javascript" src="/Public/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/Public/lib/layer/2.1/layer.js"></script>
<script type="text/javascript" src="/Public/lib/My97DatePicker/WdatePicker.js"></script>
<script type="text/javascript" src="/Public/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/Public/static/h-ui/js/H-ui.js"></script>
<script type="text/javascript" src="/Public/static/h-ui.admin/js/H-ui.admin.js"></script>
<script type="text/javascript">
    $('.table-sort').dataTable({
        "aaSorting": [[1, "desc"]],//默认第几个排序
        "bStateSave": true,//状态保存
        "aoColumnDefs": [
            //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
            {"orderable": false, "aTargets": [0]}// 制定列不参与排序
        ]
    });
    //修改分店状态
    $(document).on('click','.check_status',function(){
        if (confirm('你确定要执行此操作吗？')) {
            var status = $(this).attr('status');
            var course_id = $(this).attr('course_id');
            var _this = $(this);
            $.ajax({
                url      : 'check_status',
                type     : 'GET',
                data     : {status:status,course_id:course_id},
                dataType : 'text',
                success  : function(data){
                    if (data == 1) {
                        _this.attr({title:'禁用',status:data});
                        _this.find('i').html('&#xe631;');
                        _this.parent().prev().find('span').html('正常');
                        _this.parent().prev().find('span').attr('class','label label-success radius');
                    }else{
                        _this.attr({title:'正常',status:data});
                        _this.find('i').html('&#xe6e1;');
                        _this.parent().prev().find('span').html('禁用');
                        _this.parent().prev().find('span').attr('class','label label-defaunt radius');
                    }
                }
            })
        }
    })   
</script>
</body>
</html>