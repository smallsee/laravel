<?php

namespace App\Http\Controllers\View;

use App\Http\Controllers\Controller;
use App\Models\M3Result;
use App\Tool\Qiniu\Oauth;
use Illuminate\Http\Request;
use App\Tool\UUID;
use Log;

class UploadController extends Controller{

    public function toMap(){
        return view('map');
    }

    public function toQqLogin(){
        include app_path().'/Tool/Qqlogin/qqConnectAPI.php';
        $auth = new \Oauth();
        $accessToken = $auth->qq_callback();
        $openid = $auth->get_openid();
        var_dump($openid);
        var_dump('--------');
        $qc = new \QC($accessToken, $openid);
        $userinfo = $qc->get_user_info();
        dd($userinfo);
        exit;
    }

    public function toQq(){
        include app_path().'/Tool/Qqlogin/qqConnectAPI.php';
        $qc = new \QC();
       $qc->qq_login();
    }

    public function toA(Request $request){
        $a = $_FILES['imgFile'];

        $m3_result = new M3Result();
        $public_dir = sprintf('/uploads/%s/%s/', 'picture', date('Ymd') );
        $upload_dir = public_path() . $public_dir;
        if( !file_exists($upload_dir) ) {
            mkdir($upload_dir, 0777, true);
        }
        // 获取文件扩展名
        $arr_ext = explode('.', $_FILES["imgFile"]['name']);
        $file_ext = count($arr_ext) > 1 && strlen( end($arr_ext) ) ? end($arr_ext) : "unknow";

        $upload_filename = UUID::create();
        $upload_file_path = $upload_dir . $upload_filename . '.' . $file_ext;

        if( move_uploaded_file($_FILES["imgFile"]["tmp_name"], $upload_file_path) )
        {
            $public_uri = $public_dir . $upload_filename . '.' . $file_ext;

            $m3_result->error = 0;
            $m3_result->url = $public_uri;

        }


        return $m3_result->toJson();

    }

    public function toB(Request $request){
       $a =  $request->input('parent_id','');

        dd($a);


    }

    public function toUpload(){
        return view('upload');
    }
    public function toFile(Request $request){

        $file = $request->file('myfile');



        return $file;
    }

}