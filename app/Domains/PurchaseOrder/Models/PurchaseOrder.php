<?php

namespace App\Domains\PurchaseOrder\Models;

use App\Domains\PurchaseOrder\Enums\PurchaseOrderFulfillmentStatus;
use App\Domains\PurchaseOrder\Enums\PurchaseOrderPaymentStatus;
use App\Domains\PurchaseOrder\Enums\PurchaseOrderStatus;
use Illuminate\Database\Eloquent\Model;

/**
 * Summary of PurchaseOrder
 *
 * @property ?int $purchase_request_id This is only use for reference only, to indicates that the PurchaseOrder belongs to specific PurchaseRequest
 * @property PurchaseOrderStatus $status
 * @property PurchaseOrderFulfillmentStatus $fulfillment_status
 * @property PurchaseOrderPaymentStatus $payment_status
 * @property int $id
 * @property int $supplier_id
 * @property int $user_id
 * @property string|null $remarks
 * @property string|null $order_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Domains\PurchaseOrder\Models\PurchaseOrderItem> $purchaseOrderItems
 * @property-read int|null $purchase_order_items_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseOrder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseOrder newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseOrder query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseOrder whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseOrder whereFulfillmentStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseOrder whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseOrder whereOrderDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseOrder wherePaymentStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseOrder wherePurchaseRequestId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseOrder whereRemarks($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseOrder whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseOrder whereSupplierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseOrder whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseOrder whereUserId($value)
 * @mixin \Eloquent
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
