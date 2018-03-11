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
                    if (!empty($_FILES["img"]["tmp_name"])) {
                        //文件上传
                        $info = $this->upload_images($_FILES["img"], array('jpg', 'png', 'jpeg'), "course/" . date(Ymd));
                        if (!is_array($info)) {// 上传错误提示错误信息
                            throw new \Exception('图片上传失败.');
                        } else {// 上传成功 获取上传文件信息
                            $data['img_url'] = '/Data/UploadFiles/' . $info['savepath'] . $info['savename'];
                            $img = array('img_url' => $data['img_url'], 'status' => 1, 'create_time' => time(), 'from' => 1);
                            $data['img_id'] = M('ty_img')->add($img);
                        }
                    }
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
                print_r($data);
                die();

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
                    if (!empty($_FILES["img"]["tmp_name"])) {
                        //文件上传
                        $info = $this->upload_images($_FILES["img"], array('jpg', 'png', 'jpeg'), "course/" . date(Ymd));
                        if (!is_array($info)) {// 上传错误提示错误信息
                            throw new \Exception('图片上传失败.');
                        } else {// 上传成功 获取上传文件信息
                            $data['img_url'] = '/Data/UploadFiles/' . $info['savepath'] . $info['savename'];
                            $img = array('img_url' => $data['img_url'], 'status' => 1, 'create_time' => time(), 'from' => 1);
                            $data['img_id'] = M('ty_img')->add($img);
                        }
                    }
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

}