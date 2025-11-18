<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commodity_request extends Model
{
    //
      protected $fillable = [
        'user_id','price','payment_plan','payment_option',
        'status','note','payment_amount'
    ];


     public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    
}
