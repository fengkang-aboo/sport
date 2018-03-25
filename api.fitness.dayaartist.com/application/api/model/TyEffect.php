<?php
/**
 * Created by PhpStorm.
 * User: Blacky
 * Date: 2017/10/13
 * Time: 19:16
 */

namespace app\api\model;

class TyEffect extends BaseModel
{
    protected $autoWriteTimestamp = true;
    //protected $hidden = ['create_time','update_time','main_img_id','img_id','logo_id'];

    public static function EffectList()
    {
        $Effect = self::where('status',1)->select();
        return $Effect;
    }
}