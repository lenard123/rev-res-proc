<?php

namespace App\Domains\PurchaseOrder\Enums;

enum PurchaseOrderFulfillmentStatus : string
{
    case OPEN = 'open';
    case PARTIALLY_RECEIVED = 'partially_received';
    case CLOSED = 'closed';
}