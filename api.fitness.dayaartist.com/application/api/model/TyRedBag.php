<?php
/**
 * Created by PhpStorm.
 * User: Blacky
 * Date: 2017/10/13
 * Time: 19:16
 */

namespace app\api\model;

class TyRedBag extends BaseModel
{
    protected $autoWriteTimestamp = true;

    /**
     * 获取红包
     * @return \think\Paginator
     */
    public static function getRedBag($red_bag_id)
    {
        $where = array('id'=>$red_bag_id);
        $red_bag = self::where($where)->where('end_time','>',time())->find();
        return $red_bag;
    }

    /**
     * 获取场馆红包
     * @return \think\Paginator
     */
    public static function getVenueRedBag($venue_id)
    {
    	$where = array('venue_id'=>$venue_id);
    	$venueRedBag = self::where($where)->where('start_time','<',time())->where('end_time','>',time())->select();
    	return $venueRedBag;
    }
}