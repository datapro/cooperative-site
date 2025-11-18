<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    //
        protected $fillable = [
        'user_id','requested_amount','principal_remaining','interest_rate',
        'status','term_months','next_due_date','g_form'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transactions() 
    { 
        return $this->hasMany(Transaction::class);
     }

   
}
