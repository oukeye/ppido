<?php
/**
 * Created by PhpStorm.
 * User: oukeye
 * Date: 2018/11/20
 * Time: 0:36
 */

namespace app\api\model;

use think\Model;

class House extends BaseModel
{

    public function houseBanner()
    {
        return $this->hasMany('house_banner', 'house_id', 'id')->where(['status' => 1])->order('weight desc,id');
    }
    public function houseFurniture()
    {
        return $this->hasMany('house_furniture', 'house_id', 'id');
    }

    public function coverPhoto()
    {
        return $this->belongsTo('Img', 'pic_id', 'id')->bind([
            'picUrl'=>'url'
        ]);
    }

    public function Publicity()
    {
        return $this->belongsTo('publicity_house','id','house_id')->bind([
            'publicity_id'=>'publicity_id'
        ]);
    }

    public static function queryHouse($where, $page = 1, $pageSize = 10)
    {

        $list = self::with(['coverPhoto','houseFurniture','houseFurniture.furniture'])
            ->where($where)->page($page, $pageSize)->order('id', 'asc')->select();

        return $list;
    }
    public static function queryPublicityHouse($where, $page = 1, $pageSize = 10)
    {

        $where['status'] = 1;
        $list = self::with(['coverPhoto','houseBanner' => ['panorama', 'items', 'items.img']])
            ->where($where)->page($page, $pageSize)->order('id', 'asc')->select();

        return $list;
    }
    public static function queryPublicityHouseForEdit($where, $page = 1, $pageSize = 10)
    {

        $where['status'] = 1;
        $list = self::with(['coverPhoto','Publicity'])
            ->where($where)->page($page, $pageSize)->order('id', 'asc')->select();

        return $list->toArray();
    }

    public static function countHouse($where)
    {
        $where['status'] = 1;
        $count = self::where($where)->count(1);
        return $count;
    }

    public static function getDetailEditById($id)
    {

        $data = self::with(['coverPhoto','houseFurniture', 'houseBanner' => ['panorama', 'items', 'items.img']])->where(['id' => $id])->find();

        return $data;
    }

    public static function getDetailById($id)
    {
        $act = self::with(['houseFurniture','houseFurniture.furniture','houseBanner' => ['panorama', 'items', 'items.img']])
            ->where(['id' => $id])->find();
        return $act;
    }

}