<?php
/**
 * Created by 七月.
 * Author: 七月
 * 微信公号：小楼昨夜又秋风
 * 知乎ID: 七月在夏天
 * Date: 2017/2/26
 * Time: 14:15
 */

namespace app\api\controller\v2;

use app\api\validate\IDMustBePositiveInt;
use think\Controller;
use app\api\model\TyCourse as CourseModel;
use app\api\model\TyCourseArrange as CourseArrange;
use app\api\model\TyImg as ImgModel;
use app\api\model\TyVenueBranch as VenueBranch;
use app\api\model\TyEffect as EffectModel;
use app\api\model\Category as CategoryModel;

class Search extends Controller
{   
    /**
     * 搜索
     * @param int info 搜索内容
     * @param int typer 类型 1课程 2
     * @return \think\Paginator
     * @throws ThemeExceptio
     */
    public function getSearchInfo($name,$effect_id,$type_id,$longitude='116.353892',$latitude='39.968871')
    {
        $venue_id = '';
        $course_id = '';

        if (!empty($name)) { 

            $course = CourseModel::searchCourseName($name);
            $venue = VenueBranch::searchVenueName($name);

            foreach ($course as $key => $v) {
                $venue_id .= ','.$v['venue_branch_id'];
                $course_id .= ','.$v['id'];
            }

        }else{

            if (!empty($effect_id)) {
                $course = CourseModel::searchEffectCourse($effect_id);
                /*echo '<pre>';
                print_r($course->toArray());die;*/
                foreach ($course as $key => $v) {
                    $venue_id .= ','.$v['venue_branch_id'];
                    $course_id .= ','.$v['id'];
                }
            }

            if (!empty($type_id)) {
                $course = CourseModel::searchTypeCourse($type_id);

                foreach ($course as $key => $v) {
                    $venue_id .= ','.$v['venue_branch_id'];
                    $course_id .= ','.$v['id'];
                }
            }
        }

        //去掉两边逗号
        $venue_id = trim($venue_id,',');
        $course_id = trim($course_id,',');

        $venue_id = explode(',', $venue_id);
        $course_id = explode(',', $course_id);

        $venue_id = array_unique($venue_id);
        $course_id = array_unique($course_id);

        $venue_id = implode(',', $venue_id);
        $course_id = implode(',', $course_id);

        $venue = VenueBranch::getManyVenye($venue_id);
        $courseTime = CourseArrange::searchCourseTime($course_id);

        $courseData = array();
        foreach ($courseTime as $key => $v) {
            $course_img = ImgModel::getOneImg($v['course']['main_img_id']);
            $courseData[] = array('time_id'=>$v['id'],'course_img'=>$course_img['img_url'],'course_name'=>$v['course']['name'],'teacher_name'=>$v['teacher']['name'],'date'=>date('Y-m-d',$v['start_time']),'time'=>date('H:i:s',$v['start_time']).'-'.date('H:i:s',$v['end_time']),'price'=>$v['course']['price'],'venue_key_word'=>$v['venue']['key_word']);
        }
        //print_r($venue);die;
        foreach ($venue as $key => $v) {
            $distance = getdistances($longitude,$latitude,$v['longitude'],$v['latitude']);
            $venue[$key]['distance'] = round($distance/1000,1);
            $main_img = ImgModel::getOneImg($v['main_img_id']);
            $logo_img = ImgModel::getOneImg($v['logo_id']);
            $venue[$key]['main_img'] = $main_img['img_url'];
            $venue[$key]['log_img'] = $logo_img['img_url'];
        }

        sortArrByOneField($venue,'distance',false);

        $returnData = array('courseData'=>$courseData,'venue'=>$venue);

        return [
            'code' => 200,
            'data' => $returnData
        ];
    }

    /**
     * 功效
     * @return \think\Paginator
     * @throws ThemeExceptio
     */
    public function effectList()
    {
        $effectList = EffectModel::EffectList();
        if (!empty($effectList)) {
            return [
                'code' => 200,
                'data' => $effectList
            ];
        }else{
            return [
                'code' => 404,
                'msg' => '暂无数据'
            ];
        }
    }

    /**
     * 分类
     * @return \think\Paginator
     * @throws ThemeExceptio
     */
    public function typeList()
    {
        $TypeList = CategoryModel::TypeList();
        if (!empty($TypeList)) {
            return [
                'code' => 200,
                'data' => $TypeList
            ];
        }else{
            return [
                'code' => 404,
                'msg' => '暂无数据'
            ];
        }
    }
}