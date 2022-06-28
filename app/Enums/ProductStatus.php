<?php
namespace App\Enums;

use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Names;
use ArchTech\Enums\Options;
use ArchTech\Enums\Values;

enum ProductStatus:int
{
    use InvokableCases, Names, Values, Options;

    case PUBLISHED  = 1;
    case DRAFT = 2;
    case DISABLED = 0;
}
