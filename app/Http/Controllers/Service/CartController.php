<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use App\Entity\Category;
use Illuminate\Http\Request;
use App\Models\M3Result;

class CardController extends Controller
{
 public function addCard(Request $request,$product_id){

    $bk_card = $request->cookie('bk_card');
    $bk_card_arr = $bk_card != null ? explode(',',$bk_card) : array();

     $count = 1;
     foreach ($bk_card_arr as $value){
         $index = strpos($value,':');
         if (substr($value,0,$index) == $product_id){
             $count = ((int) substr($value,$index)) + 1;
             $value = $product_id.':'.$count;
             break;
         }
     }

     if ($count == 1){
         array_push($bk_card_arr,$product_id.':'.$count);
     }

     $m3_result = new M3Result();
     $m3_result->status = 0;
     $m3_result->message = '添加成功';

     return 


 }
}
