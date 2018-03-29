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
     * 获取课程时间列表
     * @return \think\Paginator
     */
    public static function getNewRedBag()
    {
        $where = array('user_id'=>$user_id,'red_bag_id'=>1);
        $red_bag = self::where($where)->find();
    	return $red_bag;
    }
}