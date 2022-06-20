<?php
namespace App\Enums;
use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Names;
use ArchTech\Enums\Values;
use ArchTech\Enums\Options;

enum OrderStatus:string
{
    use InvokableCases, Names, Values, Options;

    case PENDING   = 'Pending';
    case PROCESSING = 'Processing';
    case SHIPPED    = 'Shipped';
    case DELIVERED  = 'Delivered';
    case COMPLETED = 'Completed';
    case CANCELED = 'Canceled';
}
