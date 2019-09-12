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
use app\api\service\ServiceType as ServiceTypeService;
use app\lib\exception\ReceiveServiceTypeException;

class ServiceType extends Controller {

    public function create(){

        $dataArray = input('post.');

        $houseM = ServiceTypeService::create($dataArray);

        $this->result($houseM, 0, '成功');
    }

    public function edit(){

        $dataArray = input('post.');

        $houseM = ServiceTypeService::edit($dataArray);

        $this->result($houseM, 0, '成功');
    }

    public function detail()
    {

        $request = Request::instance();
        $params = $request->param();

        $list = ServiceTypeService::getDetailById($params['id']);

        $this->result($list, 0, '成功');
    }

    public function queryList()
    {
        $request = Request::instance();
        $params = $request->param();

        /*     $where = array_filter($params, function($v, $k) {
                 return in_array($k,['house_style','rooms','halls']);
             }, ARRAY_FILTER_USE_BOTH);*/

        $list = ServiceTypeService::queryList([], $params['page'], $params['pageSize']);

        $data = $list->toArray();

        $this->result($data, 0, '成功');
    }


}