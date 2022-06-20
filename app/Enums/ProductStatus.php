<?php
namespace App\Enums;

enum ProductStatus
{
    case PUBLISHED  = 1;
    case DRAFT = 2;
    case DISABLED = 0;
}
