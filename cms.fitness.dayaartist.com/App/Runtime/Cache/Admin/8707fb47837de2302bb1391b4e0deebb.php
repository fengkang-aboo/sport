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
    <script type="text/javascript" src="/Public/lib/html5.js"></script>
    <script type="text/javascript" src="/Public/lib/respond.min.js"></script>
    <script type="text/javascript" src="/Public/lib/PIE_IE678.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="/Public/static/h-ui/css/H-ui.min.css"/>
    <link rel="stylesheet" type="text/css" href="/Public/static/h-ui.admin/css/H-ui.admin.css"/>
    <link rel="stylesheet" type="text/css" href="/Public/lib/Hui-iconfont/1.0.7/iconfont.css"/>
    <link rel="stylesheet" type="text/css" href="/Public/lib/icheck/icheck.css"/>
    <link rel="stylesheet" type="text/css" href="/Public/static/h-ui.admin/skin/default/skin.css" id="skin"/>
    <link rel="stylesheet" type="text/css" href="/Public/static/h-ui.admin/css/style.css"/>
    <link rel="stylesheet" href="/Public/lib/zTree/v3/css/zTreeStyle/zTreeStyle.css" type="text/css">
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
    <title>老师列表</title>
</head>
<body class="pos-r">

<div style="margin-left:0px;">
    <nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 课程管理 <span class="c-gray en">&gt;</span> 老师安排<a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新"><i class="Hui-iconfont">&#xe68f;</i></a></nav>

    <!-- <div class="cl pd-5 bg-1 bk-gray mt-20" style="margin-left: 20px"><span class="l" style="margin-right: 10px"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> <a class="btn btn-primary radius" onclick="" href="<?php echo U('Course/add_teacher');?>"><i class="Hui-iconfont">&#xe600;</i> 添加老师</a></span><a href="<?php echo U('Excels/expSupplier');?>?category_id=<?php echo ($category_id); ?>&status=<?php echo ($status); ?>"><input class="btn btn-success radius" id="aaa" type="button" value="Excel导出"></a> <span class="r">共有数据：<strong><?php echo ($count); ?></strong> 条</span></div> -->
    <div class="cl pd-5 bg-1 bk-gray mt-20" style="margin-left: 20px"><span class="l" style="margin-right: 10px"><a class="btn btn-primary radius" onclick="" href="<?php echo U('Course/add_teacher');?>"><i class="Hui-iconfont">&#xe600;</i> 添加老师</a></span><span class="l" style="margin-right: 10px"><a href="javascript:;" class="btn btn-danger radius" id='del'><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a></span><span class="r">共有数据：<strong><?php echo ($count); ?></strong> 条</span></div>
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
                    <th width="20">ID</th>
                    <th width="70">头像</th>
                    <th>姓名</th>
                    <th width="400">介绍</th>
                    <th width="50">状态</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <!-- 遍历 -->
                <?php if(is_array($teacher)): $i = 0; $__LIST__ = $teacher;if( count($__LIST__)==0 ) : echo "暂时没有数据" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr class="text-c va-m">
                        <td><input type="checkbox" name="delID" value="<?php echo ($v["id"]); ?>"></td>
                        <td><?php echo ($v["id"]); ?></td>
                        <td><img src="<?php echo ($v["img"]); ?>" width="70"></td>
                        <td><?php echo ($v["name"]); ?></td>
                        <td><?php echo ($v["content"]); ?></td>
                        <td class="td-status">
                            <?php if($v["status"] == 1): ?><span class="label label-success radius">正常</span>
                                <?php else: ?>
                                <span class="label label-danger radius">关闭</span><?php endif; ?>
                        </td>
                        <td class="td-manage">
                            <a style="text-decoration:none" class="ml-5" href="<?php echo U('Course/add_teacher');?>?id=<?php echo ($v["id"]); ?>" title="编辑">编辑</a>
                        </td>
                    </tr><?php endforeach; endif; else: echo "暂时没有数据" ;endif; ?>
                <!-- 遍历 -->
                </tbody>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript" src="/Public/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/Public/lib/layer/2.1/layer.js"></script>
<script type="text/javascript" src="/Public/lib/My97DatePicker/WdatePicker.js"></script>
<script type="text/javascript" src="/Public/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/Public/lib/zTree/v3/js/jquery.ztree.all-3.5.min.js"></script>
<script type="text/javascript" src="/Public/static/h-ui/js/H-ui.js"></script>
<script type="text/javascript" src="/Public/static/h-ui.admin/js/H-ui.admin.js"></script>
<script type="text/javascript">
    $('.table-sort').dataTable({
        "aaSorting": [[1, "desc"]],//默认第几个排序
        "bStateSave": true,//状态保存
        "aoColumnDefs": [
            {"orderable": false, "aTargets": [0,2,3,4,5,6]}// 制定列不参与排序
        ]
    });

    //批量删除
    $('#del').on('click',function(){
        var checkID = '';
        $("input[name='delID']:checked").each(function(i){
            checkID += ','+ $(this).val();
        });
        
        checkID = checkID.substr(1);
        $.ajax({
            url : 'teacher_del',
            type : 'GET',
            data : {del_id : checkID},
            dataType : 'json',
            success : function(data){
                
                if (data.code == 200) {
                    window.location.reload();
                }else{
                    alert(data.msg)
                }
                $("input[name='delID']").attr('checked',false);
            }
        })
    })

</script>
</body>
</html>