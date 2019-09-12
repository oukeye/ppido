<?php
/**
 * Created by PhpStorm.
 * User: oukeye
 * Date: 2018/2/8
 * Time: 13:50
 */


namespace app\api\controller;

use app\api\service\Token as TokenService;
use app\api\service\UserToken as UserTokenService;
use think\Controller;
use think\Request;
use app\api\service\User as UserService;

class User extends Controller
{
    public function getUserByToken()
    {

        $uid = TokenService::getCurrentUid();

        $user = UserTokenService::getUserByUid($uid);

        $this->result($user, 0, '成功');

    }
    public function userList(){

        $request = Request::instance();
        $params = $request->param();

   /*     $where = array_filter($params, function($v, $k) {
            return in_array($k,['house_style','rooms','halls']);
        }, ARRAY_FILTER_USE_BOTH);*/

        $list = UserService::userList([], $params['page'], $params['pageSize']);

        $this->result($list, 0, '成功');

    }
}