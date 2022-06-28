<?php
namespace App\Enums;

use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Names;
use ArchTech\Enums\Options;
use ArchTech\Enums\Values;

enum UserStatus:int
{
    use InvokableCases, Names, Values, Options;

    case ACTIVE   = 5;
    case INACTIVE = 10;
}
