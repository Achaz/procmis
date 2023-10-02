<?php

namespace App\Models;

use App\Enums\UserRole;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, HasApiTokens;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'user_id',
        'email_verified_at',
        'type'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }


   /**
    * The users that belong to the User
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    */
   public function company(): HasOne
   {
       return $this->hasOne(Company::class);
   }

   /**
    * Get all of the users for the User
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
   public function users(): HasMany
   {
       return $this->hasMany(User::class);
   }

   public function assignedRoles(): Attribute
   {
     return Attribute::make(
       get: fn () => implode(', ', $this->roles->pluck('name')->all())
     );
   }

   public function isTenantAdmin(): bool
   {
     return $this->hasRole(UserRole::TenantAdmin->value);
   }

}
