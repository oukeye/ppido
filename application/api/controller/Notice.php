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
use app\api\service\Notice as NoticeService;
use app\api\service\NoticeLog as NoticeLogService;
use app\api\service\Token as TokenService;
use app\lib\exception\ReceiveNoticeException;

class Notice extends Controller {

    public function create(){

        $dataArray = input('post.');

        $houseM = NoticeService::create($dataArray);

        $this->result($houseM, 0, '成功');
    }

    public function edit(){

        $dataArray = input('post.');

        $houseM = NoticeService::edit($dataArray);

        $this->result($houseM, 0, '成功');
    }

    public function detail()
    {

        $request = Request::instance();
        $params = $request->param();

        $list = NoticeService::getDetailById($params['id']);

        $this->result($list, 0, '成功');
    }

    public function queryList()
    {
        $request = Request::instance();
        $params = $request->param();

        /*     $where = array_filter($params, function($v, $k) {
                 return in_array($k,['house_style','rooms','halls']);
             }, ARRAY_FILTER_USE_BOTH);*/

        $list = NoticeService::queryList([], $params['page'], $params['pageSize']);

        $data = $list->toArray();

        $this->result($data, 0, '成功');
    }

    public function lastNotice()
    {

        $notice = NoticeService::getLastDetail();

        try{
            $uid = TokenService::getCurrentUid();

            $logNotice = [
                'user_id'=>$uid,
                'notice_id'=>$notice['id']
            ];
            NoticeLogService::create($logNotice);
        }catch (\Exception $e){

        }


        $this->result($notice, 0, '成功');
    }


}