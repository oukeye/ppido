<?php
/**
 * Created by PhpStorm.
 * User: oukeye
 * Date: 2018/2/12
 * Time: 15:37
 */

namespace app\api\service;

use app\api\service\Wx as WxService;
use app\api\model\Publicity as PublicityModel;
use  think\Collection;
class Publicity
{

    public static function createWcQrCode($fileName, $scene)
    {

        $wxService = new WxService();

        $wx = $wxService->getWxAccessToken();

        if (empty($wx)) {
            throw new Exception('微信内部错误TOKEN失败');
        }

        $qrCodeRul = $wxService->get_code($fileName, $scene, $wx['access_token'], 'pages/house/publicity/index',1000);

        if (empty($qrCodeRul)) {
            throw new Exception('生成二维码失败');
        } else {
            $qrCodeRul = str_replace('\\', '/', $qrCodeRul);
            return $qrCodeRul;
        }
    }

    public static function find($where)
    {
        return PublicityModel::with(['banner', 'avatar'])->where($where)->find();
    }

    public static function create($data)
    {

        $PublicityMol = new PublicityModel($data);
        $PublicityMol->allowField(true)->save();

        return $PublicityMol->id;
    }

    public static function edit($data)
    {

        $publicity = PublicityModel::get($data['id']);

        if (empty($publicity)) {
            throw new EditPublicityException('不存在此宣传页');
        }

        $publicity->allowField(true)->isUpdate(true)->save($data);

        return $publicity->id;
    }

    public static function addHouse($id,$list)
    {

        $publicity = PublicityModel::get($id);

        $result = false;
        foreach ($list as $key => $data) {
            $publicityHouse = $publicity->publicityHouse()->where($data)->find();
            if(empty($publicityHouse)){
                $result = $publicity->publicityHouse()->save($data);
            }else{
                $result = $publicityHouse->save($data);
            }

        }
        return $result;

    }
    public static function delHouse($publicity_id,$id)
    {

        $publicity = PublicityModel::get($publicity_id);


        $re =$publicity ->publicityHouse()->delete($id);

        return $re;

    }

    public static function queryList($where, $page, $pageSize)
    {
        $list = PublicityModel::queryList($where, $page, $pageSize);
        return $list;
    }

    public static function queryHouseList($where, $page, $pageSize)
    {

        $paginateHouses = PublicityModel::queryHouseList($where, $page, $pageSize);

        if($paginateHouses->isEmpty()){
            return  collection([
                'data'=>[],
                'total'=>0
            ]);
        }

        return $paginateHouses;
    }


}