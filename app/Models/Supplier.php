<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;

class Supplier extends Model
{
    use HasFactory, Notifiable;
    
    protected $fillable = [
        'name',
        'user_id',
        'email',
        'phone',
        'address', 
        'city',
        'state',
        'zipcode',
        'country'
    ];

    public static function getCustomColumns(): array
    {
            return [
            'id',
            'name',
            'user_id',
            'email',
            'phone',
            'address', 
            'city',
            'state',
            'zipcode',
            'country'
            ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
