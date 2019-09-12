<?php
/**
 * Created by PhpStorm.
 * User: oukeye
 * Date: 2018/11/28
 * Time: 18:06
 */

namespace app\api\service;

use app\api\model\Wx as WxModel;
use think\Exception;
use think\Image;
use app\lib\exception\WxChatException;

class Wx
{
    protected $accessTokenUrl;

    function __construct()
    {
        $this->wxAppId = config('wx.app_id');
        $this->wxAppSecret = config('wx.app_secret');
        $this->accessTokenUrl = sprintf(config('wx.access_token_url'), $this->wxAppId, $this->wxAppSecret);
    }

    public function queryWxAccessToken()
    {
        $result = curl_get($this->accessTokenUrl);
        $wxResult = json_decode($result, true);
        if (empty($wxResult)) {
            throw new Exception('网络繁忙,微信内部错误');
        } else {
            $loginFail = array_key_exists('errcode', $wxResult);
            if ($loginFail) {
                $msg = $wxResult['errmsg'] . '-' . $wxResult['errcode'];
                throw new WxChatException($msg);
            } else {

                $wxResult['expires_time'] = date("Y-m-d H:i:s", strtotime('+' . $wxResult['expires_in'] . 'seconds'));
                return $wxResult;
            }
        }
    }

    public function getWxAccessToken()
    {
        $wx = WxModel::getWxByAppId($this->wxAppId);

        if (empty($wx)) {
            $wx = $this->queryWxAccessToken();
            $wx['app_id'] = $this->wxAppId;
            $this->saveWx($wx);
        }
        return $wx;
    }

    public function saveWx($WXArray)
    {
        $wxMo = new WxModel();

        $wx = $wxMo::get($WXArray['app_id']);

        if ($wx) {
            $WXArray['id'] = $wx->id;
            $wxMo->allowField(true)->isUpdate(true)->save($WXArray);
        } else {
            $wxMo->create($WXArray);
        }

        $prefix = config("cacheKey.WX:ACCESSTOKEN:");

        CacheHandler::save($prefix . $WXArray['app_id'], json_encode($WXArray));
    }

    public function get_code($fileName, $scene, $access_token, $page = '', $width = 430, $auto_color = false, $is_hyaline = false,$folder_name='publicity')
    {
        $url = "https://api.weixin.qq.com/wxa/getwxacodeunlimit?access_token={$access_token}";

        $data = json_encode([
            "width" => $width,
            "scene" => $scene,
            "page" => $page,
            'auto_color' => $auto_color,
            'is_hyaline' => $is_hyaline
        ]);
        $res = httpRequest($url, $data, 'POST');

        try {
            $wxResult = json_decode($res, true);
            if (empty($wxResult)) {
                throw new Exception('网络繁忙,微信内部错误');
            } else {
                $wxFail = array_key_exists('errcode', $wxResult);
                if ($wxFail) {
                    $msg = $wxResult['errmsg'] . '-' . $wxResult['errcode'];
                    throw new WxChatException($msg);
                }
            }
        } catch (\Exception $e) {

        }

        $base64_image = "data:image/jpeg;base64," . base64_encode($res);

        //二维码本地化路径

        $name = $fileName . '.jpg';

        if ($is_hyaline) {
            $name = $fileName . '.png';
        }

        $saveUrl = 'qrcode' . DS . $folder_name;

        $path = config('setting.upLoad_path') . $saveUrl;


        if (!is_dir($path)) { //判断目录是否存在 不存在就创建
            mkdir($path, 0777, true);
        }

        $this->file_put($base64_image, $path . DS . $name, LOCK_EX);

        return $saveUrl . DS . $name;
    }

    public function file_put($base64_image_content, $new_file)
    {
        header('Content-type:text/html;charset=utf-8');
        if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64_image_content, $result)) {
            if (file_put_contents($new_file, base64_decode(str_replace($result[1], '', $base64_image_content)))) {
                return true;
            } else {
                return false;
            }
        }
    }


}