<?php
/**
 * Created by PhpStorm.
 * User: oukeye
 * Date: 2018/2/12
 * Time: 15:37
 */

namespace app\api\service;

use app\api\model\Notice as NoticeModel;
use app\api\model\UserNotice as UserNoticeModel;
use app\lib\exception\ReceiveNoticeException;

class Notice
{
    protected $hide = [];

    public static function create($data){

        $noticeMo = new NoticeModel;
        $noticeMo->allowField(true)->save($data);

        return $noticeMo;
    }

    public static function edit($data){

        $noticeMo = new NoticeModel;
        $noticeMo->allowField(true)->save($data,['id' => $data['id']]);

        return $noticeMo;
    }

    public static function getDetailById($id)
    {
        return NoticeModel::getDetailById($id);
    }

    public static function getLastDetail()
    {
        return NoticeModel::getLastDetail();
    }

    public static function queryList($where, $page, $pageSize)
    {
        return NoticeModel::queryList($where, $page, $pageSize);
    }



}