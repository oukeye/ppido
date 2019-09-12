<?php
/**
 * Created by PhpStorm.
 * User: oukeye
 * Date: 2018/2/12
 * Time: 15:37
 */

namespace app\api\service;

use app\api\model\ServiceType as ServiceTypeModel;
use app\api\model\UserServiceType as UserServiceTypeModel;
use app\lib\exception\ServiceTypeException;

class ServiceType
{
    protected $hide = [];

    public static function create($data){

        $noticeMo = new ServiceTypeModel;

        $re= ServiceTypeModel::getDetailByName($data['name']);

        if($re){
            throw new ServiceTypeException('服务类型名称已经存在');
        }

        $noticeMo->allowField(true)->save($data);

        return $noticeMo;
    }

    public static function edit($data){

        $noticeMo = new ServiceTypeModel;
        $noticeMo->allowField(true)->save($data,['id' => $data['id']]);

        return $noticeMo;
    }

    public static function getDetailById($id)
    {
        return ServiceTypeModel::getDetailById($id);
    }

    public static function queryList($where, $page, $pageSize)
    {
        return ServiceTypeModel::queryList($where, $page, $pageSize);
    }



}