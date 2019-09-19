<?php
/**
 * Created by PhpStorm.
 * User: oukeye
 * Date: 2018/2/12
 * Time: 15:37
 */

namespace app\api\service;

use app\api\model\Lawyer as LawyerModel;
use app\lib\exception\ReceiveLawyerException;

class Lawyer
{
    protected $hide = [];

    public static function create($data){

        $itemMo = new LawyerModel();
        $itemMo->allowField(true)->save($data);

        return $itemMo;
    }

    public static function edit($data){

        $itemMo = new LawyerModel();
        $itemMo->allowField(true)->save($data,['id' => $data['id']]);

        return $itemMo;
    }

    public static function getDetailById($id)
    {
        return LawyerModel::getDetailById($id);
    }

    public static function getLastDetail()
    {
        return LawyerModel::getLastDetail();
    }

    public static function queryList($where, $page, $pageSize)
    {
        return LawyerModel::queryList($where, $page, $pageSize);
    }



}