<?php
namespace App\Enums;

use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Names;
use ArchTech\Enums\Options;
use ArchTech\Enums\Values;

enum UserRole:string
{
    use InvokableCases, Names, Values, Options;

    case SUPERADMIN = 'Super-Admin';
    case ADMIN = 'Admin';
    case SHOPMANAGER = 'Shop-Manager';
    case CUSTOMER = 'Customer';
}
