<?php
/**
 * Created by PhpStorm.
 * User: oukeye
 * Date: 2018/2/28
 * Time: 22:43
 */

namespace app\api\model;

use think\Model;

class Publicity extends  BaseModel
{
    public function getQrCodeUrlAttr($value, $data)
    {
        return config('setting.image_host') .'qrcode/publicity/'. $data['id'].'.jpg';

    }

    public function banner()
    {
        return $this->belongsTo('Img', 'banner_id', 'id')->bind([
            'banner_url'=>'url'
        ]);
    }
    public function avatar()
    {
        return $this->belongsTo('Img', 'avatar_id', 'id')->bind([
            'avatar_url'=>'url'
        ]);
    }

    public function publicityHouse()
    {
        return $this->hasMany('publicityHouse', 'publicity_id', 'id');
    }
    public function houses()
    {
        return $this->belongsToMany('House','\app\api\model\PublicityHouse','house_id','publicity_id')->order('pivot.id desc');
    }

    public static function queryList($where = [], $page = 1, $pageSize = 10)
    {
        $list = self::with(['banner','avatar'])->paginate($pageSize,false,['page'=>$page]);

        return $list;
    }

    public static function countList($where)

    {
        $count = self::where($where)->count(1);

        return $count;
    }

    public static function queryHouseList($where = [], $page = 1, $pageSize = 10)
    {

        $publicity = self::get($where['id']);

        $house = $publicity->houses();

        $publicityHouses = $house->with(['coverPhoto'])->order('pivot.id')->paginate($pageSize,false,['page'=>$page]);

        return $publicityHouses;
    }

}