<?php
/**
 * Created by PhpStorm.
 * User: oukeye
 * Date: 2018/2/12
 * Time: 15:37
 */

namespace app\api\service;

use app\api\model\Img as ImgModel;
use think\Request;

class Img
{
    protected $hide = [];

    public static function create($data){
        $time = time();
        $timeStr = date("Y-m-d H:i:s", $time);


        $data['type'] = 1;
        $data['create_time'] = $timeStr;
        $data['update_time'] = $timeStr;

        $ImgModel = new ImgModel;
        $ImgModel->allowField(true)->data($data);

       $ImgModel->save();

        return $ImgModel;
    }

    public static function uploadImage($files,$FolderName='other')
    {
        $request = Request::instance();
        // 获取表单上传文件
        $files = $request->file();

        if (!empty($files['file'])) {
            $file = $files['file'];
        } else {
            $file = $files[0];

        }

        $saveUrl = 'uploads' . DS . $FolderName;

        $path = config('setting.upLoad_path') . $saveUrl;


        $info = $file->validate(['ext' => 'jpg,png,gif'])->move($path);

        if ($info) {
            return $saveUrl . DS . $info->getSaveName();
        } else {
            return '';
            // 上传失败获取错误信息
//                echo $file->getError();
        }
    }

    public static function upload($folderName='other')
    {
        $dataArray = input('post.');

        $url = self::uploadImage($_FILES,$folderName);

        if ($url) {
            $url = str_replace('\\', '/', $url);
            $data = [
                'url' => $url
            ];
            $image = self::create($data);
        }
        $data = $image->toArray();
        $data['url_tmp']=$url;
        $data = array_merge($data, $dataArray);

        return  $data;

    }
}