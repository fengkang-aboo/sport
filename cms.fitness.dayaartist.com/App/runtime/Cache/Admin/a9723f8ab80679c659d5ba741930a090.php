<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8"/>
    <title>编辑更新老师信息</title>
    <script src="jquery.min.js"></script>
</head>
<body>

<center>
    <form method="post" action="<?php echo U(CourseTeacher/editTeacher);?>">
        <h1 style="margin-top:200px">编辑更新老师信息</h1>
        <table>
            <tr>
                <td>老师信息</td>
            </tr>
            <tr>
                <td>老师unique_id：</td>
                <td><input type="text" name="course_name" value="0"></td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;老师原名称：</td>
                <td><input type="text" name="discribe" value="30分钟学会弹钢琴"></td>
            </tr>
            <tr>
                <td>老师联系方式：</td>
                <td><input type="text" name="course_name" value="15510996092"></td>
            </tr>
            <tr>
                <td>老师名称：</td>
                <td><input type="text" name="teacher_name[]" value="coco"></td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;教学经验：</td>
                <td><input type="text" name="experience[]" value="2-4年"></td>
            </tr>
            <tr>
                <td>适合人群：</td>
                <td><input type="text" name="students[]" value="零基础"></td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;老师介绍：</td>
                <td><input type="text" name="introduce[]" value="经验丰富"></td>
            </tr>
            <tr>
                <td>修改后联系方式：</td>
                <td><input type="text" name="tel[]" value="15510996092"></td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;老师照片：</td>
                <td><input type="text" name="main_img_url[]" value="http://cms.joyfamliy.com/Data/UploadFiles/literature/product-class@14.jpg"></td>
            </tr>
            <tr>
                <td><input type="submit" value="下一步"></td>
            </tr>
        </table>
    </form>
</center>
</body>
</html>