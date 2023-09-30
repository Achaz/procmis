<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invitation extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'email',
        'invitation_token',
        'registered_at',
        'user_id'
    ];

    protected $casts = [
      'registered_at' => 'datetime'
    ];

    public function generateInvitationToken(): string
    {
        return substr(md5(rand(0, 9) . $this->email . time()), 0, 32);
    }

    public function getLink() {
        return urldecode(route('register') . '?invitation_token=' . $this->invitation_token);
    }
}
