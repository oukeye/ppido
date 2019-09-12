<?php
/**
 * Created by PhpStorm.
 * User: oukeye
 * Date: 2018/11/26
 * Time: 20:00
 */

namespace app\api\controller;

use think\Request;
use think\Controller;
use app\api\service\Prod as ProdService;
use app\api\service\Img as ImgService;

class Prod extends Controller {

    public function create(){

        $dataArray = input('post.');

//        $dataArray['shop_id']=1;
        $houseM = ProdService::create($dataArray);

        $this->result($houseM, 0, '成功');
    }

    public function edit(){

        $dataArray = input('post.');

        $houseM = ProdService::edit($dataArray);

        $this->result($houseM, 0, '成功');
    }

    public function detail()
    {

        $request = Request::instance();
        $params = $request->param();

        $list = ProdService::getDetailById($params['id']);
//        $data = $list->toArray();
        $list['edit'] = false;

        $this->result($list, 0, '成功');
    }

    public function detailByShop()
    {

        $request = Request::instance();
        $params = $request->param();

        $list = ProdService::getDetailShopById($params['id']);

        $this->result($list, 0, '成功');
    }

    public function queryList()
    {
        $request = Request::instance();
        $params = $request->param();

        if(isset($params['shopId'])){
            $params['shop_id'] = $params['shopId'];
        }
            $where = array_filter($params, function($v, $k) {

                if($v){
                    return in_array($k,['shop_id']);
                }else{
                    return false;
                }

             }, ARRAY_FILTER_USE_BOTH);

        $list = ProdService::queryList($where, $params['page'], $params['pageSize']);

        $data = $list->toArray();

        $this->result($data, 0, '成功');
    }

    public function uploadAlbum(){

       $data =  ImgService::upload('album');

        $this->result($data, 0, '成功');
    }
}