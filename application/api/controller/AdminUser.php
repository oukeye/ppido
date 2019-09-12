<?php
/**
 * Created by PhpStorm.
 * User: oukeye
 * Date: 2018/2/8
 * Time: 13:50
 */


namespace app\api\controller;

use think\Controller;
use app\api\service\AdminUser as AdminUserService;
use think\Request;

class AdminUser extends Controller
{

    public function login()
    {
        $request = Request::instance();
        $params = $request->param();

        $where= [
            'account'=>$params['acc'],
            'password'=>$params['pwd'],
        ];


        $data = AdminUserService::login($where);


        $this->result($data, 0, '成功');
    }
}