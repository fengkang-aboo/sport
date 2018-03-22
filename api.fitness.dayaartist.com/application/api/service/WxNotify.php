<?php
/**
 * Created by 七月.
 * Author: 七月
 * Date: 2017/6/5
 * Time: 10:06
 */

namespace app\api\service;

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

Loader::import('WxPay.WxPay', EXTEND_PATH, '.Api.php');

class WxNotify extends \WxPayNotify
{
    //<xml>
    //<appid><![CDATA[wx2421b1c4370ec43b]]></appid>
    //<attach><![CDATA[支付测试]]></attach>
    //<bank_type><![CDATA[CFT]]></bank_type>
    //<fee_type><![CDATA[CNY]]></fee_type>
    //<is_subscribe><![CDATA[Y]]></is_subscribe>
    //<mch_id><![CDATA[10000100]]></mch_id>
    //<nonce_str><![CDATA[5d2b6c2a8db53831f7eda20af46e531c]]></nonce_str>
    //<openid><![CDATA[oUpF8uMEb4qRXf22hE3X68TekukE]]></openid>
    //<out_trade_no><![CDATA[1409811653]]></out_trade_no>
    //<result_code><![CDATA[SUCCESS]]></result_code>
    //<return_code><![CDATA[SUCCESS]]></return_code>
    //<sign><![CDATA[B552ED6B279343CB493C5DD0D78AB241]]></sign>
    //<sub_mch_id><![CDATA[10000100]]></sub_mch_id>
    //<time_end><![CDATA[20140903131540]]></time_end>
    //<total_fee>1</total_fee>
    //<trade_type><![CDATA[JSAPI]]></trade_type>
    //<transaction_id><![CDATA[1004400740201409030005092168]]></transaction_id>
    //</xml>

    public function NotifyProcess($data, &$msg)
    {
        if ($data['result_code'] == 'SUCCESS') {
            $orderNo = $data['out_trade_no'];
            Db::startTrans();
            try {
                $order = OrderModel::where('order_no', '=', $orderNo)
                    ->lock(true)
                    ->find();
                if ($order->status == 1) {
                    $service = new OrderService();
                    $stockStatus = $service->checkCourseOrderStock($order->id);
                    if ($stockStatus['pass']) {
                        $this->updateOrderStatus($order->id, true);
                        $this->reduceStock($stockStatus);
                        $this->sendCustomersSMS($order->id);
                        $this->sendVenueSMS($order->id);
                    } else {
                        $this->updateOrderStatus($order->id, false);
                    }
                }
                Db::commit();
                return true;
            } catch (Exception $ex) {
                Db::rollback();
                Log::error($ex);
                return false;
            }
        } else {
            return true;
        }
    }

    private function reduceStock($stockStatus)
    {
        foreach ($stockStatus['pStatusArray'] as $singlePStatus) {
            //            $singlePStatus['count']
            TyCourseArrange::where('id', '=', $singlePStatus['id'])
                ->setDec('stock', $singlePStatus['counts']);
        }
    }

    private function updateOrderStatus($orderID, $success)
    {
        $status = $success ?
            OrderStatusEnum::PAID :
            OrderStatusEnum::PAID_BUT_OUT_OF;
        OrderModel::where('id', '=', $orderID)
            ->update(['status' => $status]);
    }

//发送顾客短信
    private function sendCustomersSMS($orderID)
    {
// 调用示例：
        $orderData = OrderModel::where('order_no', '=', $orderID)->find();
        $venueData = TyVenueBranch::where('id', '=', $orderData->supplier_id)->find();
        $courseData = TyCourse::where('id', '=', $orderData->sid)->find();
        $teacherData = TyTeacher::where('id', '=', $orderData->service_id)->find();
        $timeData = TyCourseArrange::where('id', '=', $orderData->time_id)->find();
        $memberServiceData = BoxMemberService::where('id', '=', $orderData->time)->find();
        $phone = $memberServiceData->ytel;
        $name = $memberServiceData->yname;
        $venue_name = $venueData->name;
        $course_name = $courseData->name;
        $time = date("h:i", $timeData->start_time) . '--' . date("h:i", $timeData->end_time);
        $teacher = $teacherData->name;
        set_time_limit(0);
        header('Content-Type: text/plain; charset=utf-8');
        return SmsDemo::sendCustomersSMS($phone, $name, $venue_name, $course_name, $time, $teacher);
    }

//发送健身馆短信
    private function sendVenueSMS($orderID)
    {
// 调用示例：
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