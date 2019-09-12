<?php
/**
 * Created by PhpStorm.
 * User: oukeye
 * Date: 2018/12/3
 * Time: 23:43
 */

namespace app\api\controller;

use app\api\service\House as HouseService;
use think\Controller;
use app\api\service\Publicity as PublicityService;
use think\Request;

class Publicity extends Controller
{

    public function detail()
    {
        $request = Request::instance();
        $params = $request->param();


        $where = array_filter($params, function ($v, $k) {
            return in_array($k, ['id']);
        }, ARRAY_FILTER_USE_BOTH);


        $data = PublicityService::find($where, $where);

        /* $image_host = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/';
         $data = [
             'avatar'=>$image_host.'/static/images/avatar1.jpg',
             'tel'=>'18665555803',
             'name'=>'黄埔村云姐',
             'introduce'=>'可配套冰箱、洗衣机、床等其它生活必备品，无管理费用 地址：黄埔大兴里',
         ];*/
        $this->result($data, 0, '成功');
    }

    public function create()
    {
        $dataArray = input('post.');

        $id = PublicityService::create($dataArray);

        $this->result($id, 0, '成功');
    }

    public function edit()
    {
        $dataArray = input('post.');

        $id = PublicityService::edit($dataArray);

        $this->result($id, 0, '成功');
    }

    public function publicityList()
    {

        $request = Request::instance();
        $params = $request->param();

        /*     $where = array_filter($params, function($v, $k) {
                 return in_array($k,['house_style','rooms','halls']);
             }, ARRAY_FILTER_USE_BOTH);*/

        $list = PublicityService::queryList([], $params['page'], $params['pageSize']);

        $data = $list->toArray();

        $data['data']=$list->append(['qr_code_url'])->toArray();


        $this->result($data, 0, '成功');

    }

    public function queryHouseList()
    {
        $request = Request::instance();
        $params = $request->param();

        /*     $where = array_filter($params, function($v, $k) {
                 return in_array($k,['house_style','rooms','halls']);
             }, ARRAY_FILTER_USE_BOTH);*/

        $where = [
            'id' => $params['id']
        ];

        $list = PublicityService::queryHouseList($where, $params['page'], $params['pageSize']);

        $this->result($list->toArray(), 0, '成功');
    }

    public function addHouse()
    {

        $dataArray = input('post.');

        $id = $dataArray['id'];
        $data = $dataArray['data'];

        $id = PublicityService::addHouse($id, $data);

        $this->result($id, 0, '成功');
    }

    public function delHouse()
    {

        $dataArray = input('post.');

        $publicity_id = $dataArray['publicity_id'];
        $id = $dataArray['id'];

        $id = PublicityService::delHouse($publicity_id, $id);

        $this->result($id, 0, '成功');
    }

    public function createQrCode()
    {

        $dataArray = input('post.');

        $wxService = new PublicityService();

        $scene = $dataArray['id'];
        $fileName = $dataArray['id'];

        $res = $wxService->createWcQrCode($fileName, $scene);

        $this->result($res, 0, '成功');
    }
}