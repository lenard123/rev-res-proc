<?php

namespace App\Domains\PurchaseOrder\Enums;

enum PurchaseOrderStatus : string
{
    case DRAFT = 'draft';
    case FOR_APPROVAL = 'for_approval';
    case RETURNED = 'returned';
    case PROCESSING = 'processing';
}