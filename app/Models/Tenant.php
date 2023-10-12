<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;
use \Stancl\Tenancy\Database\Models\Tenant as BaseTenant;
class Tenant extends BaseTenant implements TenantWithDatabase
{
  use HasDatabase, Notifiable, HasDomains;

  protected $casts = [
    'active' => 'boolean'
  ];

  public static function getCustomColumns(): array
  {
    return [
      'id',
      'data',
      'email',
      'name',
      'active',
      'admin', 
      'approved_at'
    ];
  }
}
