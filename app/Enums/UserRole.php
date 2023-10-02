<?php

namespace App\Enums;

enum UserRole: string
{
  case TenantAdmin = 'Tenant Admin';
  case Sales = 'Sales';
}

