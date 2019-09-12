<?php
/**
 * Created by PhpStorm.
 * User: oukeye
 * Date: 2018/2/11
 * Time: 17:27
 */

namespace app\api\service;

use app\lib\exception\TokenException;
use think\Cache;
use think\Exception;
use think\Request;

use Firebase\JWT\JWT;
use Firebase\JWT\SignatureInvalidException;
use Firebase\JWT\BeforeValidException;
use Firebase\JWT\ExpiredException;

class Token
{
    private $tokenSale;
    private $tokenExpireIn;

    function __construct($params)
    {
        $this->$tokenSale = config('secure.token_salt');
        $this->tokenExpireIn = config('setting.token_expire_in');
    }

    public static function generateToken($id, $scope = '')
    {
        $time = time(); //当前时间
        $exp = $time + config('setting.token_expire_in');
        $userAgent = md5($_SERVER['HTTP_USER_AGENT']);

        $token = [
//            'iss' => 'http://www.helloweba.net', //签发者 可选
//            'aud' => 'http://www.helloweba.net', //接收该JWT的一方，可选
            'iat' => $time, //签发时间
            'nbf' => $time, //(Not Before)：某个时间点后才能访问，比如设置time+30，表示当前时间30秒后才能使用
            'exp' => $exp, //过期时间,这里设置2个小时
            'data' => [
                'uid' => $id,
                'scope' => $scope,
                't' => $userAgent
            ],
        ];

        $jwt = JWT::encode($token, config('secure.token_salt'));

        return $jwt;
    }

    public static function decodeToken($jwt)
    {
        $decoded_array = [];

        try {
            JWT::$leeway = 60;//当前时间减去60，把时间留点余地
            $decoded = JWT::decode($jwt, config('secure.token_salt'), array('HS256'));
            $decoded_array = (array)$decoded;
        } catch (SignatureInvalidException $e) {  //签名不正确
            throw new TokenException('token不正确');
        } catch (BeforeValidException $e) {  // 签名在某个时间点之后才能用
            throw new TokenException('token在某个时间点之后才能用');
        } catch (ExpiredException $e) {  // token过期
            throw new TokenException('token过期');
        } catch (\Exception $e) {  //其他错误
            throw new TokenException('token其他错误');
        }

        return $decoded_array['data'];
    }

    public static function getCurrentTokenUid()
    {
        $token = Request::instance()->header('token');

        if (!$token) {
            throw new TokenException();
        }

        $data = self::decodeToken($token);

        if (!$data->uid) {
            throw new TokenException();
        }

        return $data->uid;

    }

    public static function getCurrentUid()
    {
        $uid = self::getCurrentTokenUid();
        return $uid;
    }
}