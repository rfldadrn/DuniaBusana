<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class statusOrderItem extends Model
{
    use HasFactory;
    protected $table = 'status_order_item';
    protected $fillable = [
        'name',
        'description',
    ];
}
