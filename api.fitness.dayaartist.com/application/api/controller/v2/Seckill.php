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
use app\api\model\TySeckill as SeckillModel;
use app\api\model\TyImg as ImgModel;
use app\api\model\TyCourseArrange as CourseArrange;

class Seckill extends Controller
{
    /**
     *
     * @return \think\Paginator
     * @throws ThemeExceptio
     */
    public function seckillList()
    {
        $seckillListData = array();
        $date = strtotime(date('Y-m-d',strtotime('+1 day')));
        $seckillList = CourseArrange::getSeckillList($date);
        if (count($seckillList) < 1) {
            return [
                'code' => 404,
                'data' => ''
            ];
        }

        $time = date('H:i');
        if ($time > '21:00' && $time < '22:00') {
            $seckillListData['status'] = 1;
        }else{
            $seckillListData['status'] = 2;
        }

        // print_r($data->toArray());die;
        foreach ($seckillList as $key => $v) {
            $courseImg = ImgModel::getOneImg($v['course']['main_img_id']); //课程图片

            $seckillListData['data'][$key] = array(
                'time_id' => $v['id'],
                'course_img' => $courseImg['img_url'],
                'course_name' => $v['course']['name'],
                'venue_name' => $v['venue']['name'],
                'price' => $v['course']['price'],
                'seckill_price' => $v['seckill_price'],
                'date' => date('Y.m.d',$v['start_time']).' '.date('H:i',$v['start_time']).'-'.date('H:i',$v['end_time']),
                'stock' => $v['stock']
            );
        }
        //print_r($seckillListData);die;
        return $seckillListData;
    }
}