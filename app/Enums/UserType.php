<?php


namespace App\Enums;

enum UserType: string
{
  case Staff = 'Staff';
  case Supplier = 'Supplier';
  case Tenant = 'Tenant';
}

