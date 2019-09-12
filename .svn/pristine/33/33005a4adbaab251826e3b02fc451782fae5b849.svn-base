<?php
/**
 * Created by PhpStorm.
 * User: oukeye
 * Date: 2018/11/26
 * Time: 20:00
 */

namespace app\api\controller;

use think\Exception;
use think\Request;
use think\Controller;
use app\api\service\ServiceCenter as ServiceCenterService;
use app\api\service\ServiceBanner as ServiceBannerService;
use app\api\service\NoticeLog as NoticeLogService;
use app\api\model\Notice as NoticeModel;

use app\api\service\Img as ImgService;

class ServiceCenter extends Controller
{

    public function create()
    {

        $dataArray = input('post.');

        $houseM = ServiceCenterService::create($dataArray);

        $this->result($houseM, 0, '成功');
    }

    public function edit()
    {

        $dataArray = input('post.');

        $houseM = ServiceCenterService::edit($dataArray);

        $this->result($houseM, 0, '成功');
    }

    public function detail()
    {

        $request = Request::instance();
        $params = $request->param();

        $list = ServiceCenterService::getDetailById($params['id']);

        $this->result($list, 0, '成功');
    }

    public function uploadAlbum()
    {

        $data = ImgService::upload('serviceAlbum');

        $this->result($data, 0, '成功');
    }

    public function queryList()
    {

        $request = Request::instance();
        $params = $request->param();

        /*     $where = array_filter($params, function($v, $k) {
                 return in_array($k,['house_style','rooms','halls']);
             }, ARRAY_FILTER_USE_BOTH);*/

        $list = ServiceCenterService::queryList([], $params['page'], $params['pageSize']);

        $this->result($list, 0, '成功');

    }

    public function queryServiceList()
    {

        $list = ServiceCenterService::queryServiceList();

        $banners = ServiceBannerService::queryServiceList();


        $obj = [
            'services' => $list,
            'banners' => $banners,
        ];

        $this->result($obj, 0, '成功');

    }

    public function hasNewNotice()
    {

        $lastNotice = NoticeModel::getLastDetail();

        if (Collection($lastNotice)->isEmpty()) {
            $this->result(false, 0, '成功');
        }

        $list = NoticeLogService::getUserLog($lastNotice['id']);

        $this->result(!$list, 0, '成功');
    }

}