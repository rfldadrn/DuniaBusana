<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class DetailTransaction extends Model
{
    use HasFactory;
    protected $table = 'detail_transaction';
    protected $fillable = [
        'transaction_id',
        'item_id',
        'qty',
        'price',
        'note',
        'status_order_item_id',
    ];
    public function items()
    {
        return $this->belongsTo(Item::class, 'item_id','id');
    }
    public function status_order_item()
    {
        return $this->belongsTo(statusOrderItem::class, 'status_order_item_id','id');
    }
    public function trInfo(){
        return $this->belongsTo(Transaction::class, 'transaction_id','id');
    }
}
