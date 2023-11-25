<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transection extends Model
{
    use HasFactory;
    protected $fillable = [
        'start_at',
        'end_at',
        'car_id',
        'user_id',
        'total_price',
        'transaction_status',
    ];
}
