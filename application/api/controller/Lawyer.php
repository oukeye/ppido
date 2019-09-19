<?php
/**
 * Created by PhpStorm.
 * User: oukeye
 * Date: 2018/11/26
 * Time: 20:00
 */

namespace app\api\controller;

use think\Request;
use think\Controller;
use app\api\service\Lawyer as LawyerService;
use app\api\service\LawyerLog as LawyerLogService;
use app\api\service\Token as TokenService;
use app\lib\exception\ReceiveLawyerException;

class Lawyer extends Controller {

    public function create(){

        $dataArray = input('post.');

        $houseM = LawyerService::create($dataArray);

        $this->result($houseM, 0, '成功');
    }

    public function edit(){

        $dataArray = input('post.');

        $houseM = LawyerService::edit($dataArray);

        $this->result($houseM, 0, '成功');
    }

    public function detail()
    {

        $request = Request::instance();
        $params = $request->param();

        $list = LawyerService::getDetailById($params['id']);

        $this->result($list, 0, '成功');
    }

    public function queryList()
    {
        $request = Request::instance();
        $params = $request->param();

        $where = array_filter($params, function($v, $k) {
                 return in_array($k,['status']);
             }, ARRAY_FILTER_USE_BOTH);

        $list = LawyerService::queryList($where, $params['page'], $params['pageSize']);

        $data = $list->toArray();

        $this->result($data, 0, '成功');
    }

    public function lastLawyer()
    {

        $item = LawyerService::getLastDetail();

        try{
            $uid = TokenService::getCurrentUid();

            $logLawyer = [
                'user_id'=>$uid,
                'notice_id'=>$item['id']
            ];
            LawyerLogService::create($logLawyer);
        }catch (\Exception $e){

        }


        $this->result($item, 0, '成功');
    }


}