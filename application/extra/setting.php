<?php
/**
 * Created by PhpStorm.
 * User: oukeye
 * Date: 2018/2/11
 * Time: 15:42
 */
use think\Env;

$upload_path_g = dirname(ROOT_PATH) . DS . 'resource' . DS;  //生产上传路径

$envName = Env::get('PP_SYS_NAME');

if ($envName == 'dev') {
    $path = ROOT_PATH . DS . 'public' . DS; //开发上传路径
} else {
    $path = $upload_path_g;
}
//$image_host = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/';
//
$protocol = strpos(strtolower($_SERVER['SERVER_PROTOCOL']),'https')  === false ? 'http' : 'https';
//
$image_host = $protocol . '://' . $_SERVER['HTTP_HOST'] . '/';


return [
    'image_prefix' => 'http://192.168.6.218:1110/images',
    'token_expire_in' => 86400, //过期时间,这里设置1天   86400 s,
    'upLoad_path' => $path,
    'image_host' => $image_host,
];