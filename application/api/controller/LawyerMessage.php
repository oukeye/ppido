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
use app\api\service\LawyerMessage as LawyerMessageService;

class LawyerMessage extends Controller {

    public function create(){

        $dataArray = input('post.');

        $houseM = LawyerMessageService::create($dataArray);

        $this->result($houseM, 0, '成功');
    }

    public function edit(){

        $dataArray = input('post.');

        $houseM = LawyerMessageService::edit($dataArray);

        $this->result($houseM, 0, '成功');
    }

    public function detail()
    {

        $request = Request::instance();
        $params = $request->param();

        $list = LawyerMessageService::getDetailById($params['id']);

        $this->result($list, 0, '成功');
    }

    public function queryList()
    {
        $request = Request::instance();
        $params = $request->param();

        $where = array_filter($params, function($v, $k) {
                 return in_array($k,['status']);
             }, ARRAY_FILTER_USE_BOTH);

        $list = LawyerMessageService::queryList($where, $params['page'], $params['pageSize']);

        $data = $list->toArray();

        $this->result($data, 0, '成功');
    }

}