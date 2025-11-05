<?php

namespace App\Domains\Procurement\Models;

use App\Domains\Procurement\Enums\PurchaseRequestOrderStatus;
use App\Domains\Procurement\Enums\PurchaseRequestStatus;
use App\Domains\Procurement\Factories\PurchaseRequestFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Summary of PurchaseRequest
 * @property int $id
 * @property mixed $created_at
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

    protected static function newFactory()
    {
        return PurchaseRequestFactory::new();
    }
}
