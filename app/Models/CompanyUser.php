<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Spatie\Permission\Models\Role;

class CompanyUser extends Pivot
{
    use HasFactory;

    protected $table = 'company_users';

    protected $casts = [
        'status' => 'array'
    ];
}
