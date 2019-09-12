<?php
/**
 * Created by PhpStorm.
 * User: oukeye
 * Date: 2018/2/12
 * Time: 15:37
 */

namespace app\api\service;

use app\api\model\ServiceBanner as ServiceBannerModel;


class ServiceBanner
{
    protected $hide = [];

    public static function create($data){

        $serviceCenterMo = new ServiceBannerModel();
        $serviceCenterMo->allowField(true)->save($data);

        return $serviceCenterMo;
    }
    public static function edit($data){

        $serviceCenterMo = new ServiceBannerModel();
        $serviceCenterMo->allowField(true)->save($data,['id' => $data['id']]);

        return $serviceCenterMo;
    }

    public static function getDetailById($id)
    {
        return ServiceBannerModel::getDetailById($id);
    }
    public static function getDetailCouponById($id)
    {
        return ServiceBannerModel::getDetailCouponById($id);
    }

    public static function queryList($where, $page, $pageSize)
    {
        return ServiceBannerModel::queryList($where, $page, $pageSize);
    }
    public static function queryServiceList()
    {
        return ServiceBannerModel::queryServiceList();
    }

}