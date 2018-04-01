<?php
/**
 * Created by PhpStorm.
 * User: Blacky
 * Date: 2017/10/13
 * Time: 19:16
 */

namespace app\api\model;

class TyUserRedBag extends BaseModel
{
    //protected $autoWriteTimestamp = true;

    //关联场馆
    public function user()
    {
        return $this->belongsTo('User','user_id','id');
    }

    //关联场馆
    public function venue()
    {
        return $this->belongsTo('TyVenueBranch','venue_id','id');
    }

    /**
     * 获取用户红包
     * @return \think\Paginator
     */
    public static function getUserRedBag($uid,$red_bag_id)
    {
        $where = array('user_id'=>$uid,'red_bag_id'=>$red_bag_id);
        $red_bag = self::where($where)->find();
    	return $red_bag;
    }

    /**
     * 获取用户分享红包
     * @return \think\Paginator
     */
    public static function getUserRandRedBag($uid,$share_red_bag_id)
    {
        $where = array('user_id'=>$uid,'share_red_bag_id'=>$share_red_bag_id);
        $red_bag = self::where($where)->find();
        return $red_bag;
    }

    /**
     * 获取领取分享用户
     * @return \think\Paginator
     */
    public static function ReceiveShareRedBagUser($share_red_bag_id)
    {
        $where = array('share_red_bag_id'=>$share_red_bag_id);
        $red_bag = self::with('user')->where($where)->select();
        return $red_bag;
    }

    /**
     * 获取领取分享用户
     * @return \think\Paginator
     */
    public static function getUserAllRedBag($uid)
    {
        $where = array('user_id'=>$uid);
        $user_red_bag = self::with('venue')->where($where)->where('end_time','>',time())->select();
        return $user_red_bag;
    }
}