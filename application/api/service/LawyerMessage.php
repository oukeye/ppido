<?php
/**
 * Created by PhpStorm.
 * User: oukeye
 * Date: 2018/2/12
 * Time: 15:37
 */

namespace app\api\service;

use app\api\model\LawyerMessage as LawyerMessageModel;

class LawyerMessage
{
    protected $hide = [];

    public static function create($data){

        $itemMo = new LawyerMessageModel();
        $itemMo->allowField(true)->save($data);

        return $itemMo;
    }

    public static function edit($data){

        $itemMo = new LawyerMessageModel();
        $itemMo->allowField(true)->save($data,['id' => $data['id']]);

        return $itemMo;
    }

    public static function getDetailById($id)
    {
        return LawyerMessageModel::getDetailById($id);
    }

    public static function getLastDetail()
    {
        return LawyerMessageModel::getLastDetail();
    }

    public static function queryList($where, $page, $pageSize)
    {
        return LawyerMessageModel::queryList($where, $page, $pageSize);
    }



}