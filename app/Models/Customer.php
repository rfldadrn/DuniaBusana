<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Customer extends Model
{
    use HasFactory;
    protected $table = 'customer';
    protected $fillable = [
        'customer_name',
        'phone',
        'address',
        'gender',
    ];

    public function Transaction()
    {
        return $this->hasMany(Transaction::class, 'customer_id','id');
    }
}
