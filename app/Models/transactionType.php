<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class transactionType extends Model
{
    protected $table = 'transaction_type';
    protected $fillable = [
        'name',
        'description',
        'is_active',
    ];
}
