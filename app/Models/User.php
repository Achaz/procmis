<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
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
        'email_verified_at'
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
   public function companies(): BelongsToMany
   {
       return $this->belongsToMany(Company::class,"company_users", 'user_id', 'company_id')->withPivot('status');
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

}
