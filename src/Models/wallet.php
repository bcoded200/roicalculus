<?php

namespace Codedhub\Roicalculus\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class wallet extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'coin_name',
        'coin_balance',
        'coin_image',
        'coin_action',
        'coin_status',
        'coin_address'
    ];
}
