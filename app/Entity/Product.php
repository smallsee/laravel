<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class Product extends Model

{
    const AK = '-xpzbXEV0gDocV0_SsQFn-WYczH9kPQr27wtYQ_2';
    const SK = 'Lpynlw9BBhexmODsMV0a4-v-Kzp6zm_njdXaTUxJ';
    const DOMAIN = 'ocm761z5p.bkt.clouddn.com';
    const BUCKET = 'yii-xiaohai';

    protected $table = 'product';
    protected $primaryKey = 'id';

    //public $timestamps = false;
}
