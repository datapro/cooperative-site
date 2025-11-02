<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    //
      protected $fillable = [
        'user_id',
        'requested_amount',
        'g_form',
        'deducted_from_savings',
        'amount_borrowed',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function repayments()
    {
        return $this->hasMany(\App\Models\LoanRepayment::class);
    }
}
