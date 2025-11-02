<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanRepayment extends Model
{
    //
    
    protected $fillable = [
        'loan_id',
        'user_id',
        'amount',
        'payment_date',
        'status',
    ];

    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
