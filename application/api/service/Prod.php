<?php
/**
 * Created by PhpStorm.
 * User: oukeye
 * Date: 2018/2/12
 * Time: 15:37
 */

namespace app\api\service;

use app\api\model\Prod as ProdModel;

class Prod
{
    protected $hide = [];

    public static function create($data){

        $ImgModel = new ProdModel;
        $ImgModel->allowField(true)->create($data);

        return $ImgModel;
    }
    public static function edit($data){

        $ImgModel = new ProdModel;
        $ImgModel->allowField(true)->save($data,['id' => $data['id']]);

        return $ImgModel;
    }

    public static function getDetailById($id)
    {
        return ProdModel::getDetailById($id);
    }
    public static function getDetailShopById($id)
    {
        return ProdModel::getDetailShopById($id);
    }

    public static function queryList($where, $page, $pageSize)
    {
        return ProdModel::queryList($where, $page, $pageSize);
    }
}