<?php
/**
 * Created by PhpStorm.
 * User: oukeye
 * Date: 2018/2/12
 * Time: 15:37
 */

namespace app\api\service;

use app\api\model\ServiceContacts as ServiceContactsModel;
use app\api\model\UserServiceContacts as UserServiceContactsModel;
use app\lib\exception\ServiceContactsException;

class ServiceContacts
{
    protected $hide = [];

    public static function create($data){

        $noticeMo = new ServiceContactsModel;

        $noticeMo->allowField(true)->save($data);

        return $noticeMo;
    }

    public static function edit($data){

        $noticeMo = new ServiceContactsModel;
        $noticeMo->allowField(true)->save($data,['id' => $data['id']]);

        return $noticeMo;
    }

    public static function getDetailById($id)
    {
        return ServiceContactsModel::getDetailById($id);
    }

    public static function queryListByTypeId($where, $page, $pageSize)
    {
        return ServiceContactsModel::queryListByTypeId($where, $page, $pageSize);
    }



}