<?php

namespace Admin\Controller;

use Think\Controller;

class CourseController extends PublicController
{

    /*
*
* 构造函数，用于导入外部文件和公共方法
*/
    public function _initialize()
    {
        $this->category = M('category');
        // 获取所有分类，进行关系划分
        $list = $this->category->where('pid=0')->order('sort desc,id asc')->select();
        foreach ($list as $k1 => $v1) {
            $list[$k1]['list2'] = $this->category->where('pid=' . intval($v1['id']))->select();
            foreach ($list[$k1]['list2'] as $k2 => $v2) {
                $list[$k1]['list2'][$k2]['list3'] = $this->category->where('pid=' . intval($v2['id']))->select();
            }
        }

        $this->assign('list', $list);// 赋值数据集

//        获取所有分店进行分类
        $this->ty_venue_branch = M('ty_venue_branch');
        $venueList = $this->ty_venue_branch->order('id desc')->select();
        $this->assign('venueList', $venueList);

        //        获取所有课程信息
        $this->ty_course = M('ty_course');
        $courseList = $this->ty_course->order('id desc')->select();
        $this->assign('courseList', $courseList);

        //        获取所有老师信息
        $this->ty_teacher = M('ty_teacher');
        $teacherList = $this->ty_teacher->order('id desc')->select();
        $this->assign('teacherList', $teacherList);
    }

    //***********************************
    // 课程列表
    //**********************************
    public function course_index()
    {
        $course = M('ty_course as course')->field('course.*,ty_img.img_url')->join('ty_img on course.main_img_id=ty_img.id')->select();
        $count = count($course);
//        print_r($course);die();
        $this->assign('course', $course);
        $this->assign('count', $count);
        $this->display();
    }

    public function course_add()
    {
        if (IS_POST) {
            try {
                $Model = M(); // 实例化一个空对象
                $Model->startTrans(); // 开启事务
                $data = I('post.');
//                print_r($data);
//                die();

                if (empty($data['main_img_id']) && empty($data['img_id'])) {
                    //上传商品图片
                    if (!empty($_FILES["main_img"]["tmp_name"])) {
                        //文件上传
                        $info = $this->upload_images($_FILES["main_img"], array('jpg', 'png', 'jpeg', 'mp4'), "course/" . date(Ymd));
                        if (!is_array($info)) {// 上传错误提示错误信息
                            throw new \Exception('图片上传失败.');
                        } else {// 上传成功 获取上传文件信息
                            $data['main_img_url'] = '/Data/UploadFiles/' . $info['savepath'] . $info['savename'];
                            $main_img = array('img_url' => $data['main_img_url'], 'status' => 1, 'create_time' => time(), 'from' => 1);
//                        print_r($main_img);die();
                            $data['main_img_id'] = M('ty_img')->add($main_img);
                        }
                    }
                    //上传产品首页展示图
//                    if (!empty($_FILES["img"]["tmp_name"])) {
//                        //文件上传
//                        $info = $this->upload_images($_FILES["img"], array('jpg', 'png', 'jpeg'), "course/" . date(Ymd));
//                        if (!is_array($info)) {// 上传错误提示错误信息
//                            throw new \Exception('图片上传失败.');
//                        } else {// 上传成功 获取上传文件信息
//                            $data['img_url'] = '/Data/UploadFiles/' . $info['savepath'] . $info['savename'];
//                            $img = array('img_url' => $data['img_url'], 'status' => 1, 'create_time' => time(), 'from' => 1);
//                            $data['img_id'] = M('ty_img')->add($img);
//                        }
//                    }
                    //多张商品轮播图上传
                    $up_arr = array();
                    if (!empty($_FILES["venue_imgs"]["tmp_name"])) {
                        foreach ($_FILES["venue_imgs"]['name'] as $k => $val) {
                            $up_arr[$k]['name'] = $val;
                        }

                        foreach ($_FILES["venue_imgs"]['type'] as $k => $val) {
                            $up_arr[$k]['type'] = $val;
                        }

                        foreach ($_FILES["venue_imgs"]['tmp_name'] as $k => $val) {
                            $up_arr[$k]['tmp_name'] = $val;
                        }

                        foreach ($_FILES["venue_imgs"]['error'] as $k => $val) {
                            $up_arr[$k]['error'] = $val;
                        }

                        foreach ($_FILES["venue_imgs"]['size'] as $k => $val) {
                            $up_arr[$k]['size'] = $val;
                        }
                    }
                    if ($up_arr) {
                        $venue_img_id = '';
                        foreach ($up_arr as $key => $value) {
                            $info = $this->upload_images($value, array('jpg', 'png', 'jpeg'), "product/" . date(Ymd));
                            if (is_array($info)) {
                                // 上传成功 获取上传文件信息保存数据库
                                $adv_str = '/Data/UploadFiles/' . $info['savepath'] . $info['savename'];
                                $img = array('img_url' => $adv_str, 'status' => 1, 'create_time' => time(), 'from' => 1);

                                $img_id = M('ty_img')->add($img);
                                $venue_img_id .= ',' . $img_id;
                            }
                        }

                    }
                    $data['img_id'] = trim($venue_img_id, ',');

                }
                //商品详情添加
                if ($data['main_img_id'] && $data['img_id']) {
                    $data['status'] = 1;
//                    print_r($data);die;
                    if (empty($data['id'])) {
                        $ty_course = M('ty_course')->add($data);
                    } else {
                        $data['update_time'] = time();
                        $ty_course = M('ty_course')->where('id=' . intval($_POST['id']))->save($data);
                    }
                } else {
                    throw new \Exception('请上传图片.');
                }
                if ($ty_course) {
                    $Model->commit(); // 成功则提交事务
                    $this->success('编辑成功', U('Admin/Course/course_index'));

                } else {
                    throw new \Exception('编辑失败,请重新编辑');
                }
            } catch (\Exception $e) {
                // 否则将事务回滚
                $Model->rollback();
                $this->error($e->getMessage());
            }

        } elseif ($_GET['id']) {
            $course_id = I('get.id');
            $course = M('ty_course')->where('id=' . $course_id)->find();
            $this->assign('course', $course);
            $this->display();
        } else {
            $this->display();
        }
    }

    //***********************************
    // 课程预览
    //**********************************
    public function course_preview()
    {
        $id = $_GET['id'];
        $course = M('ty_course')->where('id=' . $id)->find();
//        查询图片信息
        $main_img = M('ty_img')->where('id=' . $course['main_img_id'])->getField('img_url');
        $img_id = explode(',', $course['img_id']);
        $where['id'] = array('in', $img_id);
        $img_url = M('ty_img')->where($where)->getField('img_url', true);
//        查询分店、类型
        $venue_branch =M('ty_venue_branch')->where('id='.$course['venue_branch_id'])->getField('name');
        $type =M('ty_type')->where('id='.$course['type_id'])->getField('name');
        $course['main_img'] = $main_img;
        $course['img'] = $img_url;
        $course['venue_branch'] = $venue_branch;
        $course['type'] = $type;
//        print_r($course);die;
        $this->assign('course', $course);
        $this->display();
    }

    //***********************************
    // 老师列表
    //**********************************
    public function teacher_index()
    {
        $teacher = M('ty_teacher as teacher')->select();
        $count = count($teacher);
        $this->assign('teacher', $teacher);
        $this->assign('count', $count);
        $this->display();
    }

    //***********************************
    // 老师添加
    //**********************************
    public function add_teacher()
    {
        if (IS_POST) {
            $data = I('post.');
            //上传产品首页展示图
            if (!empty($_FILES["img"]["tmp_name"])) {
                //文件上传
                $info = $this->upload_images($_FILES["img"], array('jpg', 'png', 'jpeg'), "teacher/" . date(Ymd));
                //print_r($info);die;
                if (!is_array($info)) {// 上传错误提示错误信息
                    throw new \Exception('图片上传失败.');
                } else {// 上传成功 获取上传文件信息
                    $data['img'] = '/Data/UploadFiles/' . $info['savepath'] . $info['savename'];
                    $img = array('img_url' => $data['img_url'], 'status' => 1, 'create_time' => time(), 'from' => 1);
                }
            }

            if (empty($data['id'])) {
                $data['create_time'] = time();
                $ty_course = M('ty_teacher')->add($data);
            } else {

                $data['update_time'] = time();
                $ty_course = M('ty_teacher')->where('id=' . intval($_POST['id']))->save($data);
            }
            if ($ty_course) {
                $this->success('编辑成功', U('Admin/Course/teacher_index'));

            } else {
                throw new \Exception('编辑失败,请重新编辑');
            }

        } else {
            if (isset($_GET['id'])) {
                $where['id'] = $_GET['id'];
                $teacher = M('ty_teacher')->where($where)->find();
                $this->assign('teacher', $teacher);
            }
            $this->display();
        }
    }


    //***********************************
    // 课程表
    //**********************************
    public function course_time()
    {
        $where = array();
        $course_time = M('ty_course_arrange as ca')
            ->where($where)
            ->field('ca.*,course.name as course_name,teacher.name as teacher_name,venue.name as venue_name')
            ->join('ty_course as course on ca.course_id=course.id')
            ->join('ty_teacher as teacher on ca.teacher_id=teacher.id')
            ->join('ty_venue_branch as venue on ca.venue_branch_id=venue.id')
            ->select();
        foreach ($course_time as $key => $v) {
            $course_time[$key]['time'] = $v['dates'] . ' ' . date('H:i', $v['start_time']) . '-' . date('H:i', $v['end_time']);
        }
        $count = count($course_time);
        $this->assign('course_time', $course_time);
        $this->assign('count', $count);
        $this->display();
    }

    public function time_add()
    {
        if (IS_POST) {
            try {
                $Model = M(); // 实例化一个空对象
                $Model->startTrans(); // 开启事务
                $data = I('post.');
//                print_r($data);
//                die();
                if (empty(($data['start_times'][0]))) {
                    throw new \Exception('时间不能为空');
                    exit();
                }
//                循环添加预约时间段
                for ($i = 0; $i < count($data['start_times']); $i++) {
                    if (strtotime($data['start_times'][$i]) > strtotime($data['end_times'][$i])) {
                        throw new \Exception('结束时间必须大于开始时间,请重新添加');
                        exit();
                    }
                    $times_array = array(
                        'venue_branch_id' => $data['venue_branch_id'],
                        'course_id' => $data['course_id'],
                        'teacher_id' => $data['teacher_id'],
                        'stock' => $data['stock'],
                        'dates' => date('Y-m-d', strtotime($data['end_times'][$i])),
                        'start_time' => strtotime($data['start_times'][$i]),
                        'end_time' => strtotime($data['end_times'][$i]),
                        'is_seckill' => $data['is_seckill'], 'seckill_price' => $data['seckill_price'],
                        'create_time' => $data['create_time'] ? $data['create_time'] : time(),
                        'update_time' => time());

                    if (empty($data['id'])) {
                        $result = M('ty_course_arrange')->add($times_array);
                    } else {
                        $data['update_time'] = time();
//                        print_r($times_array);
//                        die();
                        $result = M('ty_course_arrange')->where('id=' . intval($_POST['id']))->save($times_array);
                    }
                }
                if ($result) {
                    $Model->commit(); // 成功则提交事务
                    $this->success('编辑成功', U('Admin/Course/course_time'));

                } else {
                    throw new \Exception('编辑失败,请重新编辑');
                }
            } catch (\Exception $e) {
                // 否则将事务回滚
                $Model->rollback();
                $this->error($e->getMessage());
            }

        } elseif ($_GET['id']) {
            $arrange_id = I('get.id');
            $arrange = M('ty_course_arrange')->where('id=' . $arrange_id)->find();
            $arrange['start_time'] = date('y-m-d H:i', $arrange['start_time']);
            $arrange['end_time'] = date('y-m-d H:i', $arrange['end_time']);
            $this->assign('arrange', $arrange);
            $this->display();
        } else {
            $this->display();
        }
    }

}