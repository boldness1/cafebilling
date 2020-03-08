<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //


     public function order(){

                return $this->hasMany('App\Order');



     }

public function basket(){


    return $this->hasMany('App\Basket');


}




}
