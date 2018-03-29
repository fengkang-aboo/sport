<?php
/**
 * Created by 七月.
 * Author: 七月
 * 微信公号：小楼昨夜又秋风
 * 知乎ID: 七月在夏天
 * Date: 2017/2/26
 * Time: 14:15
 */

namespace app\api\controller\v2;

use app\api\validate\IDMustBePositiveInt;
use think\Controller;
use app\api\service\Token;
use app\api\model\TyUserRedBag;
use app\api\model\TyRedBag;
use app\api\model\TyShareRedBag;
use think\Db;
use think\Cache;

class Redbag extends Controller
{
	/**
     * 领红包
     * @param int $red_bag_id 活动红包ID
     * @return \think\Paginator
     * @throws ThemeException
     */
    public function receiveRedBag($red_bag_id)
    {
    	$red_bag = TyRedBag::getRedBag($red_bag_id);
    	$uid = Token::getCurrentUid();
    	if (!empty($red_bag)) {
    		if ($red_bag['end_time'] < time() ) {
    			return [
					'code' => 401,
					'msg' => '红包已过期'
				];
    		}
    		$user_red_bag = TyUserRedBag::getUserRedBag($uid,$red_bag_id);

			if (empty($user_red_bag)) {
				$data = array('user_id'=>$uid,'venue_id'=>$red_bag['venue_id'],'red_bag_id'=>$red_bag['id'],'price'=>$red_bag['price'],'type'=>$red_bag['type'],'create_time'=>time());
				Db::table('ty_user_red_bag')->insert($data);
				$res_id = Db::name('ty_user_red_bag')->getLastInsID();
				if ($res_id < 1) {
					return [
						'code' => 500,
						'msg' => '服务器错误'
					];
				}else{
					return [
						'code' => 200,
						'msg' => '成功'
					];
				}
			}else{
				return [
					'code' => 400,
					'msg' => '你已经领取'
				];
			}
    	}else{
    		return [
				'code' => 404,
				'msg' => '红包不存在'
			];
    	}
	}

	/**
     * 分享红包
     * @param int $red_bag_id 活动红包ID
     * @return \think\Paginator
     * @throws ThemeException
     */
    public function shareRedBag($red_bag_id=2,$order_id=1)
    {
		$red_bag = TyRedBag::getRedBag($red_bag_id);
    	//$uid = Token::getCurrentUid();
    	$uid = 1;
    	if (!empty($red_bag)) {

    		$share_red_bag = TyShareRedBag::getShareRedBag($uid,$order_id);
    		if (!empty($share_red_bag)) {
    			return [
					'code' => 401,
					'msg' => '您已分享'
				];
    		}

    		$data = array('order_id'=>$order_id,'user_id'=>1,'red_bag_id'=>$red_bag_id,'create_time'=>time());
	    	Db::table('ty_share_red_bag')->insert($data);
	    	$res_id = Db::name('ty_share_red_bag')->getLastInsID();
	    	//echo $res_id;die;
	    	if ($res_id > 1) {

	    		$rand_array = randRedBag($red_bag['price'],$red_bag['num']);

	    		Cache::set(PREFIXRANDREDBAG.$res_id,);


	    	}else{
	    		return [
					'code' => 500,
					'msg' => '服务器错误'
				];
	    	}	
    	}else{
    		return [
				'code' => 404,
				'msg' => '红包不存在'
			];
    	}
	}

	/**
     * 领随机红包
     * @param int $red_bag_id 活动红包ID
     * @return \think\Paginator
     * @throws ThemeException
     */
    public function receiveRandRedBag($red_bag_id)
    {

	}
}