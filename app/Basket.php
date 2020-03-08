<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Basket extends Model
{

    public function customer(){


        return $this->belongsTo('App\Customer');


    }
}
