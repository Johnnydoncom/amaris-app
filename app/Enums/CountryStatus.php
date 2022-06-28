<?php
namespace App\Enums;

use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Names;
use ArchTech\Enums\Options;
use ArchTech\Enums\Values;

enum CountryStatus:int
{
    use InvokableCases, Names, Values, Options;

    case ENABLE  = 5;
    case DISABLE = 10;
}
