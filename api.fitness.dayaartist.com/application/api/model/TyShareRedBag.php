<?php
/**
 * Created by PhpStorm.
 * User: Blacky
 * Date: 2017/10/13
 * Time: 19:16
 */

namespace app\api\model;

class TyShareRedBag extends BaseModel
{
    protected $autoWriteTimestamp = true;

    /**
     * 获取分享红包
     * @return \think\Paginator
     */
    public static function getShareRedBag($uid,$order_id)
    {
        $where = array('user_id'=>$uid,'order_id'=>$order_id);
        $share_red_bag = self::where($where)->find();
    	return $share_red_bag;
    }

}