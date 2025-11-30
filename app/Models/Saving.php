<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Saving extends Model
{
    //
     use HasFactory;
     protected $fillable = [
        'user_id',
        'amount',
        'status',
        'approved_by',
        'approved_at',
        'remark',
        'total_savings',
    ];

    // Relationships
    public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}

}
