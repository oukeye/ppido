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
use app\api\service\ServiceContacts as ServiceContactsService;
use app\lib\exception\ReceiveServiceContactsException;

class ServiceContacts extends Controller {

    public function create(){

        $dataArray = input('post.');

        $houseM = ServiceContactsService::create($dataArray);

        $this->result($houseM, 0, '成功');
    }

    public function edit(){

        $dataArray = input('post.');

        $houseM = ServiceContactsService::edit($dataArray);

        $this->result($houseM, 0, '成功');
    }

    public function detail()
    {

        $request = Request::instance();
        $params = $request->param();

        $list = ServiceContactsService::getDetailById($params['id']);

        $this->result($list, 0, '成功');
    }

    public function queryListByTypeId()
    {
        $request = Request::instance();
        $params = $request->param();

         $where = array_filter($params, function($v, $k) {
             return in_array($k,['type_id','status']);
         }, ARRAY_FILTER_USE_BOTH);

        $list = ServiceContactsService::queryListByTypeId($where, $params['page'], $params['pageSize']);

        $list ->append(['albumUrl'])->toArray();

        $this->result($list, 0, '成功');
    }


}