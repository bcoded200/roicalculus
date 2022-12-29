<?php

namespace Codedhub\Roicalculus\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class earnings extends Model
{
    use HasFactory;

    protected $fillable = [

       'amount_invested	',
        'plan_name',
        'earned_amount',
        'date_invested',
        'end_date',
        // 'total_return',
        'expected_return',
        'nextprofit_date',
        'user_id',
        'invested_by',
        'counter',
        'earnings_action',
        'expired',
        'reinvest',
        'email',
        'plan_id'


    ];
}
