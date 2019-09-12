<?php
/**
 * Created by PhpStorm.
 * User: oukeye
 * Date: 2018/2/11
 * Time: 14:18
 */

namespace app\api\service;


use app\lib\exception\TokenException;
use app\lib\exception\UserMissException;
use app\lib\exception\WxChatException;
use think\Cache;
use think\Exception;
use app\api\model\User as UserModel;

class UserToken extends Token
{
    protected $code;
    protected $wxAppId;
    protected $wxAppSecret;
    protected $wxLoginUrl;

    function __construct($params)
    {
        $this->code = $params['code'];
        $this->wxAppId = config('wx.app_id');
        $this->wxAppSecret = config('wx.app_secret');
        $this->wxLoginUrl = sprintf(config('wx.login_url'), $this->wxAppId, $this->wxAppSecret, $this->code);
        $this->userInfo = $params;
    }

    public function get()
    {
        $result = curl_get($this->wxLoginUrl);
        $wxResult = json_decode($result, true);
        if (empty($wxResult)) {
            throw new Exception('网络繁忙,微信内部错误');
        } else {
            $loginFail = array_key_exists('errcode', $wxResult);
            if ($loginFail) {
                $this->processLoginError($wxResult);
            } else {
                return $this->grantToken($wxResult);
            }
        }
    }

    private function grantToken($wxResult)
    {
        // 拿到openid
        // 数据库里看一下，这个openid是否存在
        // 如果存在不处理，如果不存在那么新增一条User记录
        // 生成令牌，准备缓存数据，写入缓存
        // 把令牌返回到客户端去
        // key: 令牌
        // value: wResult,uid
        $openid = $wxResult['openid'];
        $user = UserModel::getByOpenId($openid);
        if ($user) {
            $uid = $user->id;
        } else {
            $uid = $this->newUser($openid);
        }
        if (!empty($user->account) || ($this->userInfo && $this->userInfo['nickName'])) {
            $cacheValue = $this->perpareCacheValue($wxResult, $uid);
            $token = $this->saveToCache($cacheValue);
            return $token;
        } else {
            return '';
        }

    }

    private function saveToCache($cacheValue)
    {
        $uid = $cacheValue['uid'];
        $key = $this->generateToken($uid);
        $value = json_encode($cacheValue);
        $expire_in = config('setting.token_expire_in');
        $cacheKey = config('cacheKey.USER:TOKEN:') . $uid;

        $request = cache($cacheKey, $value, $expire_in);
        if (!$request) {
            throw new TokenException([
                'message' => '服务器缓存异常',
                'errorCode' => 10005
            ]);
        }
        return $key;

    }

    private function perpareCacheValue($wxResult, $uid)
    {
        $cacheValue = $wxResult;
        $cacheValue['uid'] = $uid;
        $cacheValue['scope'] = 16;
        return $cacheValue;
    }
    function jsonName($str) {
        if($str){
//            $tmpStr = json_encode($str);
            $return = preg_replace("#(\\\ud[0-9a-f]{3})#ie","",$str);
//            $return = json_decode($tmpStr2);
            if(!$return){
                return jsonName($return);
            }
        }else{
            $return = '微信用户-'.time();
        }
        return $return;
    }
    private function newUser($openid)
    {
        $user = UserModel::create([
            'openid' => $openid,
            'account' => '',
            'uname' => $this->userInfo['nickName'],
            'addtime' => time(),
            'photo' => $this->userInfo['avatarUrl'],
            'sex' => $this->userInfo['gender'],
            'source' => 'wx_xcx'
        ]);
        return $user->id;
    }

    private function processLoginError($wxResult)
    {
        $msg = $wxResult['errmsg'] . '-' . $wxResult['errcode'];
        throw new WxChatException($msg);
    }

    public static function getUserByUid($uid)
    {
        $user = UserModel::getUserById($uid);
        if ($user) {
            return $user;
        } else {
            throw new UserMissException();
        }
    }

}