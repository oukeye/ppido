<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

return [
    '__pattern__' => [
        'name' => '\w+',
    ],
    '[hello]'     => [
        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
        ':name' => ['index/hello', ['method' => 'post']],
    ],
    'api/user/getUser' => ['api/user/getUserByToken', ['method' => 'get|post']],
    'api/user/updateUserLocation' => ['api/UserCoordinates/updateUserLocation', ['method' => 'get|post']],
    'api/user/list' => ['api/user/userList', ['method' => 'get|post']],


    'api/token/getToken' => ['api/token/getToken', ['method' => 'get|post']],

    'api/activity/create' => ['api/activity/createActivity', ['method' => 'get|post']],
    'api/activity/getActivity' => ['api/activity/getActivity', ['method' => 'get|post']],
    'api/activity/joinActivity' => ['api/activity/joinActivity', ['method' => 'get|post']],


    'api/house/create' => ['api/house/createHouse', ['method' => 'post']],
    'api/house/detail' => ['api/house/detail', ['method' => 'get|post']],
    'api/house/queryHouse' => ['api/house/queryHouse', ['method' => 'get']],
    'api/house/publicity/list' => ['api/house/publicityHouseList', ['method' => 'post']],
    'api/house/publicity/edit/list' => ['api/house/publicityHouseEditList', ['method' => 'post']],
    'api/house/banner/list' => ['api/house/bannerList', ['method' => 'get|post']],
    'api/house/add' => ['api/house/addHouse', ['method' => 'post']],

    'api/admin/login' => ['api/AdminUser/login', ['method' => 'post']],
    'api/admin/house/list' => ['api/house/houseList', ['method' => 'post']],
    'api/admin/house/apply/list' => ['api/house/applyList', ['method' => 'get']],

    'api/publicity/list' => ['api/publicity/publicityList', ['method' => 'get']],
    'api/publicity/detail' => ['api/house/detail', ['method' => 'post']],
    'api/publicity/house/list' => ['api/publicity/queryHouseList', ['method' => 'get']],
    'api/publicity/qrcode/create' => ['api/publicity/createQrCode', ['method' => 'get|post']],

    'api/prod/list' => ['api/prod/queryList', ['method' => 'get']],
    'api/prod/detailShop' => ['api/prod/detailByShop', ['method' => 'get']],


    'api/coupon/list' => ['api/coupon/queryList', ['method' => 'get']],


    'api/shop/detailCoupon' => ['api/shop/detailCoupon', ['method' => 'get']],



];
