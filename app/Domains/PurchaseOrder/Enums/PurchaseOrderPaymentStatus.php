<?php

namespace App\Domains\PurchaseOrder\Enums;

enum PurchaseOrderPaymentStatus : string
{
    case UNPAID = 'unpaid';
}