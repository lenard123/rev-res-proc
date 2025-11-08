<?php

namespace App\Domains\Procurement\Models;

use App\Domains\Procurement\Enums\PurchaseRequestOrderStatus;
use App\Domains\Procurement\Enums\PurchaseRequestStatus;
use App\Domains\Procurement\Events\PurchaseRequestProcessed;
use App\Domains\Procurement\Factories\PurchaseRequestFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Summary of PurchaseRequest
 *
 * @property int $id
 * @property mixed $created_at
 * @property PurchaseRequestStatus $status
 * @property PurchaseRequestOrderStatus $order_status
 * @property int $user_id
 * @property string|null $remarks
 * @property string|null $approved_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $transaction_no
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Domains\Procurement\Models\PurchaseRequestItem> $purchaseRequestItems
 * @property-read int|null $purchase_request_items_count
 * @method static \App\Domains\Procurement\Factories\PurchaseRequestFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseRequest newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseRequest newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseRequest query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseRequest whereApprovedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseRequest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseRequest whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseRequest whereRemarks($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseRequest whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseRequest whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseRequest whereUserId($value)
 * @mixin \Eloquent
 */
class PurchaseRequest extends Model
{
    use HasFactory;

    protected $appends = ['transaction_no'];


    protected $casts = [
        'status' => PurchaseRequestStatus::class,
        'order_status' => PurchaseRequestOrderStatus::class,
    ];

    public function purchaseRequestItems()
    {
        return $this->hasMany(PurchaseRequestItem::class);
    }

    /**
     * Get formatted transaction number (virtual attribute)
     *
     * Format: PR-YYYY-0001
     */
    public function getTransactionNoAttribute(): string
    {
        return sprintf('PR-%s%04d', $this->created_at?->format('Y') ?? now()->year, $this->id);
    }

    protected static function booted()
    {
        static::updated(function (self $pr) {

        });
    }

    protected static function newFactory()
    {
        return PurchaseRequestFactory::new();
    }
}
