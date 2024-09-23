<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ledger extends Model
{
    use HasFactory;

    protected $fillable = [
        'what',
        'where',
        'when',
        'type',
        'amount',
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}
