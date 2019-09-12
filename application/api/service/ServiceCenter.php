<?php
/**
 * Created by PhpStorm.
 * User: oukeye
 * Date: 2018/2/12
 * Time: 15:37
 */

namespace app\api\service;

use app\api\model\ServiceCenter as ServiceCenterModel;
use app\api\service\Wx as WxService;

class ServiceCenter
{
    protected $hide = [];

    public static function create($data){

        $serviceCenterMo = new ServiceCenterModel();
        $serviceCenterMo->allowField(true)->save($data);

        return $serviceCenterMo;
    }
    public static function edit($data){

        $serviceCenterMo = new ServiceCenterModel();
        $serviceCenterMo->allowField(true)->save($data,['id' => $data['id']]);

        return $serviceCenterMo;
    }

    public static function getDetailById($id)
    {
        return ServiceCenterModel::getDetailById($id);
    }
    public static function getDetailCouponById($id)
    {
        return ServiceCenterModel::getDetailCouponById($id);
    }

    public static function queryList($where, $page, $pageSize)
    {
        return ServiceCenterModel::queryList($where, $page, $pageSize);
    }
    public static function queryServiceList()
    {
        return ServiceCenterModel::queryServiceList();
    }

}