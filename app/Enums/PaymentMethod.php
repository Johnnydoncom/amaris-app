<?php
namespace App\Enums;
use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Names;
use ArchTech\Enums\Values;
use ArchTech\Enums\Options;

enum PaymentMethod:string
{
    use InvokableCases, Names, Values, Options;

    case STRIPE  = 'stripe';
    case PAYSTACK = 'paystack';
    case CASH = 'cash';
}
