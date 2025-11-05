<?php

namespace App\Domains\Procurement\Enums;

enum PurchaseRequestOrderStatus: string
{
    case NOT_ORDERED = 'not_ordered';
    case PARTIALLY_ORDERED = 'partially_ordered';
    case FULLY_ORDERED = 'fully_ordered';
    case FULFILLED = 'fulfilled';

    public function label(): string
    {
        return match($this) {
            self::NOT_ORDERED => 'Not Ordered',
            self::PARTIALLY_ORDERED => 'Partially Ordered',
            self::FULLY_ORDERED => 'Fully Ordered',
            self::FULFILLED => 'Fulfilled',
        };
    }
}
