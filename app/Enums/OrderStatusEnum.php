<?php

namespace App\Enums;

enum OrderStatusEnum:string
{
    case PENDING   = 'pending';
    case PROCESSING = 'processing';
    case COMPLETED = 'completed';
    case DECLINED = 'declined';
    case CANCELED = 'canceled';
    case PLACED  = 'Order Placed';
    case IN_PROGRESS = 'Order in Progress';
    case SHIPPED    = 'Shipped';
    case OUT_FOR_DELIVERY  = 'Out for Delivery';
    case DELIVERED  = 'Delivered';
}
