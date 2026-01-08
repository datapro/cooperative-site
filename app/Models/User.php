<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Commodity_request;
use App\Models\Loan;

class User extends Authenticatable
{
   
    
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'role',
        'occupation',
        'address',
        'membership_no',
        'ledger_no',
        'phone',
        'status',
        'passport',
        'email',
        'password',
        'savingsBF',
        'commBF'
    ];

    
    public function savings()
    {
        return $this->hasMany(Saving::class);
    }

    public function loans()
{
    return $this->hasMany(Loan::class);
}
  // 🔹 Helper: get total approved savings balance
  
    public function totalSavings()
    {
        return $this->savings()->where('status', 'approved')->sum('amount');
    }

    public function transactions()
{
    return $this->hasMany(Transaction::class, 'user_id');
}
public function commodities()
{
    return $this->hasMany(\App\Models\Commodity::class, 'user_id');
}

public function commodityRequests() {
    return $this->hasMany(Commodity_request::class,'user_id');
}


// Automatically move uploaded record to various table  
protected static function booted()
{
    static::created(function ($user) {
        $user->syncApprovedRecords();
    });

    static::updated(function ($user) {
        $user->syncApprovedRecords();
    });
}

public function syncApprovedRecords()
{
    // --- SAVINGS ---
    if ($this->savingsBF > 0) {
        Saving::updateOrCreate(
            ['user_id' => $this->id],
            [
            'amount' => (float) $this->savingsBF,
            'status' => 'approved',
            'remark' => 'saved'
            ]
        );
    }

    // --- COMMODITY ---
    if ($this->commBF > 0) {
        Commodity_request::updateOrCreate(
            ['user_id' => $this->id],
            [
                'payment_option' =>$this->payment_option ?? 'cash', // choose default
                'price' =>(float)  $this->commBF,
                'status' => 'pending'
            ]
        );
    }

    // --- LOAN ---
    // if ($this->loanBF > 0) {
    //     Loan::updateOrCreate(
    //         ['user_id' => $this->id],
    //         [
    //             'requested_amount' =>(float) $this->loanBF,  // REQUIRED FIELD
    //             // 'amount' =>(float) $this->loan,
    //             'interest_rate'=>(float) $this->loanINT,
    //             'status' => 'pending',
    //             'g_form' => $this->g_form ?? 'system-auto-approved'
    //         ]
    //     );
    // }
}


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
