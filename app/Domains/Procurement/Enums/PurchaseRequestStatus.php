<?php

namespace App\Domains\Procurement\Enums;

enum PurchaseRequestStatus: string
{
    case DRAFT = 'draft'; // Initialized the purchase requests
    case FOR_APPROVAL = 'for_approval'; // Awaiting to be approved
    case PROCESSING = 'processing'; // This stage is the part where we select supplier for each items
    case PENDING = 'pending';
    case RETURNED = 'returned';
    case REJECTED = 'rejected';
    case CLOSED = 'closed';
    case CANCELLED = 'cancelled';

    public function label(): string
    {
        return match($this) {
            self::DRAFT => 'Draft',
            self::FOR_APPROVAL => 'Pending Approval',
            self::RETURNED => 'Returned',
            self::PROCESSING => 'Processing',
            self::PENDING => 'Pending',
            self::REJECTED => 'Rejected',
            self::CLOSED => 'Closed',
            self::CANCELLED => 'Cancelled',
        };
    }
}
