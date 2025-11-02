<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Saving extends Model
{
    //
       protected $fillable = [
        'user_id',
        'amount',
        'date',
        'total_savings',
        'remark',
        'type',
       ];

  public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Helper: compute total savings balance
public function totalSavings()
{
    return $this->savings()->sum('amount');
}
}


