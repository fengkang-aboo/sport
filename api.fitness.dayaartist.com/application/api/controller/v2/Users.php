<?php 
namespace app\api\controller\v2;

use app\api\validate\IDMustBePositiveInt;
use think\Controller;
use app\lib\exception\BaseException;
use app\api\model\User;
use app\api\model\TyUserRedBag;
use app\api\service\Token;


class Users extends Controller
{
    /**
     * 添加用户信息
     * @param int $userInfo 用户id号
     * @return \think\Paginator
     * @throws ThemeException
     */
    public function addUserInfo()
    {
        $userInfo = input('post.info/a');
        
        if (empty($userInfo)) {
            throw new BaseException([
                'code' => -1,
                'msg' => '参数不能为空',
                'errorCode' => 60002
            ]);
        }

        $uid = Token::getCurrentUid();

        $user_info = User::getByOneUser($uid);
        
        if (empty($user_info)) {
            throw new BaseException([
                'code' => -1,
                'msg' => '用户不存在',
                'errorCode' => 60000
            ]);
        }else{
            $user_info = $user_info->toArray();
            $compare = array_diff($userInfo,$user_info);
            if (empty($compare)) {
                return [
                    'code' => 1,
                    'msg' => '内容一致',
                    'errorCode' => 200
                ];
            }

            $res = User::saveUserInfo($uid,$userInfo);
            if ($res) {
               return [
                    'code' => 1,
                    'msg' => '成功',
                    'errorCode' => 200
                ];                   
            }else{
                return [
                    'code' => 2,
                    'msg' => '失败',
                    'errorCode' => 404
                ];  
            }
            
        }
    }

/*    $money_total = 20;
$personal_num = 10;
$min_money = 1.6;
$money_right = $money_total;
$randMoney = [];
for($i = 1; $i <= $personal_num; $i++){
    if($i == $personal_num){
        $money = $money_right;
    }else{
        $max = $money_right * 10 - ($personal_num - $i ) * $min_money * 10;
        $money = rand($min_money * 10,$max) / 10;
        $money = sprintf("%.1f",$money);
        }
        $randMoney[] = $money;
        $money_right = $money_right - $money;
        $money_right = sprintf("%.1f",$money_right);
}

shuffle($randMoney);
echo '<pre>';
print_r($randMoney);*/

    /**
     * 获取用户是否可领新手红包
     * @param int $userInfo 用户id号
     * @return \think\Paginator
     * @throws ThemeException
     */
    public function getUserNewRedBag()
    {
        $uid = Token::getCurrentUid();
        $red_bag = TyUserRedBag::getNewRedBag($uid);
        if (empty($red_bag)) {
            return [
                'code' => 200,
                'is_receive' => 1
            ];
        }else{
           return [
                'code' => 200,
                'is_receive' => 2
            ]; 
        }
    }

}