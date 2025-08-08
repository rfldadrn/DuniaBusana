<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Transaction extends Model
{
    use HasFactory;
    protected $table = 'transaction';
    protected $fillable = [
        'order_id',
        'customer_id',
        'transaction_type_id',
        'amount',
        'paid_amount',
        'balance_due',
        'notes',
        'transaction_date',
        'completion_date',
        'payment_status_id',
        'status_transaction',
        'created_by',
        'updated_by',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id','id');
    }
    public function transaction_type()
    {
        return $this->belongsTo(transactionType::class, 'transaction_type_id','id');
    }
    public function status_payment()
    {
        return $this->belongsTo(PaymentStatus::class, 'payment_status_id','id');
    }
    public function status()
    {
        return $this->belongsTo(statusTransaction::class, 'status_transaction','id');
    }
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by','id');
    }
    public function modifier()
    {
        return $this->belongsTo(User::class, 'updated_by','id');
    }
    public function getItem()
    {
        return $this->hasMany(Item::class, 'id','transaction_id');
    }
}
