<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasUuids, SoftDeletes;
    protected $fillable = [
        'user_id', 
        'address',
        'payment',
        'total_price',
        'shipping_price',
        'status'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function items() {
        return $this->hasMany(TransactionItem::class, 'transaction_id', 'id');
    }
}
