<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Transaction extends Model
{
    protected $primaryKey = 'id';

    use HasFactory;

    protected $fillable = [
        'category',
        'user_id',
        'description',
        'amount',
        'type',
        'transaction_date',
    ];

    protected $casts = [
        'transaction_date' => 'date',
        'amount' => 'decimal:2',
    ];

    public function scopeUser($query, int $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function scopeCurrentMonth ($query)
    {
        return $query->whereMonth('transaction_date', now()->month)
                    ->whereYear('transaction_date', now()->year);
    }
}
