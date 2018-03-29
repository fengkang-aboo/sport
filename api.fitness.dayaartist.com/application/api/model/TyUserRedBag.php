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
    protected $autoWriteTimestamp = true;

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
}