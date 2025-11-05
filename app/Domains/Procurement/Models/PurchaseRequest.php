<?php

namespace App\Domains\Procurement\Models;

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

    /** 
     * Draft — created but not yet submitted for approval. 
     * Requester can still edit or cancel.
     */
    public const STATUS_DRAFT = 'draft';

    /** 
     * Pending Approval — submitted and waiting for approver’s decision. 
     * Requester can no longer modify. 
     */
    public const STATUS_PENDING_APPROVAL = 'pending_approval';

    /** 
     * Approved — fully approved and ready for procurement or sourcing. 
     * Can now be converted to purchase orders or quotations.
     */
    public const STATUS_APPROVED = 'approved';

    /** 
     * Rejected — disapproved by approver. 
     * Requester may revise and resubmit, depending on workflow rules.
     */
    public const STATUS_REJECTED = 'rejected';

    /** 
     * In Progress — under procurement process (e.g., requesting quotations, selecting suppliers).
     */
    public const STATUS_IN_PROGRESS = 'in_progress';

    /** 
     * Partially Ordered — some items have been converted to purchase orders.
     */
    public const STATUS_PARTIALLY_ORDERED = 'partially_ordered';

    /** 
     * Fully Ordered — all items in this request are already linked to purchase orders.
     */
    public const STATUS_FULLY_ORDERED = 'fully_ordered';

    /** 
     * Fulfilled — all items have been received and marked as delivered.
     */
    public const STATUS_FULFILLED = 'fulfilled';

    /** 
     * Closed — manually closed or completed; no further actions allowed.
     */
    public const STATUS_CLOSED = 'closed';

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
