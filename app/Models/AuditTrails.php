<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AuditTrails extends Model
{
    use HasFactory;
    protected $table = 'audittrails';
    protected $fillable = [
        'feature',
        'data_id',
        'detail',
        'created_by',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by','id');
    }
}
