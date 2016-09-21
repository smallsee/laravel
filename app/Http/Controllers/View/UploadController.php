<?php

namespace App\Http\Controllers\View;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Log;

class UploadController extends Controller{

    public function toUpload(){
        return view('upload');
    }
    public function toFile(Request $request){

        $file = $request->file('myfile');



        return $file;
    }

}