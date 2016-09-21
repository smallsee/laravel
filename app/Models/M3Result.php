<?php

namespace App\Models;

class M3Result {

  public $status;
  public $message;
  public $error;
  public $url;


  public function toJson()
  {
    return json_encode($this, JSON_UNESCAPED_UNICODE);
  }

    public function toSuccess()
    {
        return json_encode($this, JSON_UNESCAPED_UNICODE);
    }

}
