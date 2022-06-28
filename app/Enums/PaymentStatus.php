<?php
namespace App\Enums;

use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Names;
use ArchTech\Enums\Options;
use ArchTech\Enums\Values;

enum PaymentStatus:int
{
    use InvokableCases, Names, Values, Options;

    case PENDING  = 5;
    case CANCELED = 7;
    case PAID = 9;
    case EXPIRED = 10;
}
