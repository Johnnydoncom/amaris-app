<?php
namespace App\Enums;

enum UserRole
{
    case SUPERADMIN     = 'Super-Admin';
    case ADMIN     = 'Admin';
    case SHOPMANAGER = 'Shop-Manager';
    case CUSTOMER  = 'Customer';
}
