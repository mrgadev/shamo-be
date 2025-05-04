<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransactionItem extends Model
{
    use SoftDeletes, HasUuids;

    protected $fillable = [
        'user_id',
        'product_id',
        'transaction_id',
        'qty'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function transaction() {
        return $this->belongsTo(Transaction::class, 'transaction_id', 'id');
    }
    public function product() {
        return $this->hasOne(User::class, 'id', 'product_id');
    }
}
