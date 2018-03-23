<?php

namespace app\api\controller\v2;

use app\api\model\BoxMemberService;
use app\api\model\Order as OrderModel;
use app\api\model\TyCourse;
use app\api\model\TyCourseArrange;
use app\api\model\TyTeacher;
use app\api\model\TyVenueBranch;
use app\api\service\Order as OrderService;
use app\lib\enum\OrderStatusEnum;
use think\Db;
use think\Exception;
use think\Loader;
use think\Log;
use AliyunSms\api_demo\SmsDemo;
use think\Controller;

/*
 * Resource Sample
 */

//Loader::import('SMS.SendTemplateSMS', EXTEND_PATH, '.php');
//Loader::import('AliyunSms.SmsDemo', EXTEND_PATH, '.php');

class Sample extends Controller
{

    /**
     * Sample 样例
     * @url     /sample/:key
     * @http    get
     * @param   int $key 键
     * @return  array of values , code 200
     * @throws  MissException
     */
    public function getSample($key)
    {
//        debug('begin');
        $validate = new SampleGet();
        $validate->goCheck();
        $key = (int)$key;
        $result = SampleService::getSampleByKey($key);
        if (empty($result)) {
            throw new MissException([
                'msg' => 'sample not found'
            ]);
        }
//        debug('end');
//        echo debug('begin','end').'s';
        return $result;
//        $data = [
//            'key' => $key,
//        ];
//        $result = $this->validate($data,'BannerGet');
//        if(true !== $result){
//            // 验证失败 输出错误信息
//            dump($result);
//        }
//        $key = (int)$key;
//        $result = BannerService::getBannerByLocation($key);
//        return $result;
    }

    public function test($orderID = 'B32089522277')
    {
        $orderData = OrderModel::where('order_no', '=', $orderID)->find();
        $venueData = TyVenueBranch::where('id', '=', $orderData->supplier_id)->find();
        $courseData = TyCourse::where('id', '=', $orderData->sid)->find();
        $teacherData = TyTeacher::where('id', '=', $orderData->service_id)->find();
        $timeData = TyCourseArrange::where('id', '=', $orderData->time_id)->find();
        $memberServiceData = BoxMemberService::where('id', '=', $orderData->time)->find();
        $tel = $memberServiceData->ytel;
        $name = $memberServiceData->yname;
        $venue_name = $venueData->name;
        $phone = $venueData->tel;
        $course_name = $courseData->name;
        $time = date("h:i", $timeData->start_time) . '--' . date("h:i", $timeData->end_time);
        $teacher = $teacherData->name;
        set_time_limit(0);
        header('Content-Type: text/plain; charset=utf-8');
        return SmsDemo::sendVenueSMS($phone, $venue_name, $name, $course_name, $time, $teacher, $tel);
    }
}
