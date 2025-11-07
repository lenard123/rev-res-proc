<?php

namespace App\Domains\PurchaseOrder\Models;

use App\Domains\PurchaseOrder\Enums\PurchaseOrderFulfillmentStatus;
use App\Domains\PurchaseOrder\Enums\PurchaseOrderPaymentStatus;
use App\Domains\PurchaseOrder\Enums\PurchaseOrderStatus;
use Illuminate\Database\Eloquent\Model;

/**
 * Summary of PurchaseOrder
 * @property ?int $purchase_request_id This is only use for reference only, to indicates that the PurchaseOrder belongs to specific PurchaseRequest
 * @property PurchaseOrderStatus $status
 * @property PurchaseOrderFulfillmentStatus $fulfillment_status
 * @property PurchaseOrderPaymentStatus $payment_status
 */
class PurchaseOrder extends Model
{
    protected $casts = [
        'status' => PurchaseOrderStatus::class,
        'fulfillment_status' => PurchaseOrderFulfillmentStatus::class,
        'payment_status' => PurchaseOrderPaymentStatus::class,
    ];

    public function purchaseOrderItems()
    {
        return $this->hasMany(PurchaseOrderItem::class);
    }
}
