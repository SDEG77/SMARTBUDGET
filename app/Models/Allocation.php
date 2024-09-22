<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class Allocation extends Model
{
    use HasFactory;

    protected $fillable = [
        'food',
        'rent',
        'transportation',
        'loan',
        'shopping',
        'mobile',
        'savings',
        'school',
        'others',
    ];

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }
}
