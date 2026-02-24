<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Observers\TransactionObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;

#[ObservedBy(TransactionObserver::class)]
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

    public function scopeCurrentMonth($query)
    {
        $start = now()->startOfMonth();
        $end   = now()->endOfMonth();

        return $query->whereBetween('transaction_date', [$start, $end]);
    }

    public function scopeLastMonth($query)
    {
        $start = now()->subMonth()->startOfMonth();
        $end   = now()->subMonth()->endOfMonth();

        return $query->whereBetween('transaction_date', [$start, $end]);
    }
}
