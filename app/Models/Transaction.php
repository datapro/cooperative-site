<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    //
       protected $fillable = [
        'user_id','loan_id','type','loan_type','amount','processing_charge','note'
    ];

    public function user() { return $this->belongsTo(User::class); }
    public function loan() { return $this->belongsTo(Loan::class); }
}
