<?php
/**
 * Created by PhpStorm.
 * User: Blacky
 * Date: 2017/10/13
 * Time: 19:16
 */

namespace app\api\model;

class TyFacilities extends BaseModel
{
    protected $autoWriteTimestamp = true;
    //protected $hidden = ['create_time','update_time','main_img_id','img_id','logo_id'];

    /**
     * 获取基本设施
     * @param $id 多个id
     * @return \think\Paginator
     */
    public static function getFacilities($id)
    {
        $where['id'] = array('in',$id);
        $facilities = self::where($where)->select()->toArray();
        return $facilities;
    }
}