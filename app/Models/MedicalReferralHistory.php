<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalReferralHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'referral_id',
        'referral_details',
        'referral_date',
        'city',
    ];
}
