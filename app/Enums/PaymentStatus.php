<?php
namespace App\Enums;

interface PaymentStatus
{
    const PENDING  = 5;
    const CANCELED = 7;
    const PAID = 9;
    const EXPIRED = 10;
}
