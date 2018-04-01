<?php
/**
 * Created by PhpStorm.
 * User: Blacky
 * Date: 2017/10/13
 * Time: 19:16
 */

namespace app\api\model;

class Category extends BaseModel
{
    protected $autoWriteTimestamp = true;
    //protected $hidden = ['create_time','update_time','main_img_id','img_id','logo_id'];

    public static function TypeList()
    {
        $type = self::where('status',1)->select();
        return $type;
    }

    /**
     * 获取多个分类
     * @param $id 多个id
     * @return \think\Paginator
     */
    public static function getManyCategory($id)
    {
        $where['id'] = array('in',$id);
        $category = self::where($where)->select()->toArray();
        return $category;
    }
}