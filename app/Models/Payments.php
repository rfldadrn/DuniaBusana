<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Payments extends Model
{
    use HasFactory;
    protected $table = 'payments';
    protected $fillable = [
        'transaction_id',
        'amount',
        'payment_date',
        'payment_status_id',
        'reference',
    ];
}
