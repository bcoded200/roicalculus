<?php

namespace Codedhub\Roicalculus\Models;

use Codedhub\Roicalculus\helpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class calcplan extends Model
{
    use HasFactory,helpers;

    protected $fillable = [
            'bundle',
            'minimium',
            'maximium',
            'percentage',
            'referal_bonus',
            'duration',
            'payout',
            'no_of_times',
            'max_reinvest'
    ];
}
