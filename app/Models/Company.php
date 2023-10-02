<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Permission\Models\Role;

class Company extends Model
{
    use HasFactory;

    protected $table = 'companies';

    protected $guarded = [];
    
   

    /**
     * The users that belong to the Company
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
